using Sample.Donnees;
using Sample.Modeles;

namespace Sample.Jeu;

/// <summary>
/// Les règles du jeu. La fenêtre appelle ces méthodes, puis relit l'état pour l'afficher.
/// Tout ce qui change (la vie du héros) est enregistré en base par Entity Framework.
/// </summary>
public class Donjon
{
    public const int BONUS_MAX = 3;   // un coup reçoit un bonus au hasard : 0, 1 ou 2

    // Un seul contexte pour toute la partie : EF suit le héros et enregistre ses changements.
    private readonly SampleContext _db = new();
    private readonly Random _hasard = new();
    private readonly List<string> _journal = new();

    public EtatJoueur Joueur { get; }
    public Monstre? Adversaire { get; private set; }   // null quand on n'est pas en combat
    public int VieAdversaire { get; private set; }
    public bool EstTermine { get; private set; }

    public bool EnCombat => Adversaire != null;
    public IReadOnlyList<string> Journal => _journal;

    public Donjon()
    {
        Joueur = _db.EtatJoueur.First();   // LINQ : la première (et seule) ligne de la table
        if (Joueur.Vie == 0)
        {
            Recommencer();
        }
        Ecrire($"{Joueur.Nom} entre dans le donjon. Cliquez sur Explorer.");
    }

    /// <summary>Le contenu du sac, lu dans la table Inventaire.</summary>
    public List<ObjetInventaire> Inventaire() =>
        _db.Inventaire
            .Where(o => o.Quantite > 0)
            .OrderBy(o => o.Nom)
            .ToList();

    // ---------------------------------------------------------------------
    // Explorer : l'algorithme 
    // ---------------------------------------------------------------------

    public void Explorer()
    {
        if (EstTermine || EnCombat)
        {
            return;
        }

        // 1. Tirer au hasard un rang entre 0 et le nombre d'événements - 1.
        // 2. Prendre l'événement à ce rang (Skip = sauter les précédents).
        int nombre = _db.Evenements.Count();
        var evenement = _db.Evenements.OrderBy(e => e.Id).Skip(_hasard.Next(nombre)).First();

        Ecrire($"{evenement.Nom} : {evenement.Description}");

        // 3. Appliquer ses dégâts (négatifs = soin), puis ce qui dépend de son type.
        if (evenement.Degats != 0)
        {
            ChangerVie(-evenement.Degats);
        }

        switch (evenement.Type)
        {
            case TypeEvenement.Monstre:
                CommencerCombat();
                break;
            case TypeEvenement.Objet:
                Ecrire($"Vous voyez un objet : {evenement.Objet}.");
                break;
            case TypeEvenement.Sortie:
                Terminer("Vous avez trouvé la sortie. Victoire !");
                break;
        }

        _db.SaveChanges();   // UPDATE EtatJoueur SET Vie = ... : EF écrit le SQL pour nous
    }

    // ---------------------------------------------------------------------
    // Le combat : attaquer ou défendre jusqu'à la mort du monstre
    // ---------------------------------------------------------------------

    private void CommencerCombat()
    {
        // Même algorithme que pour les événements : un monstre au hasard.
        int nombre = _db.Monstres.Count();
        Adversaire = _db.Monstres.OrderBy(m => m.Id).Skip(_hasard.Next(nombre)).First();
        VieAdversaire = Adversaire.Vie;   // la table Monstres n'est pas modifiée : c'est un modèle

        Ecrire($"Combat ! {Adversaire.Nom} (attaque {Adversaire.Attaque}, vie {Adversaire.Vie}, "
               + $"défense {Adversaire.Defense}). Attaquez ou défendez-vous.");
    }

    public void Attaquer()
    {
        if (Adversaire == null || EstTermine)
        {
            return;
        }

        int coup = Math.Max(1, Joueur.Force + _hasard.Next(BONUS_MAX) - Adversaire.Defense);
        FrapperAdversaire(coup);
        if (Adversaire != null)
        {
            Riposte(Joueur.Defense);
        }
        _db.SaveChanges();
    }

    /// <summary>Se défendre : la défense compte double, et l'on contre-attaque d'un point.</summary>
    public void Defendre()
    {
        if (Adversaire == null || EstTermine)
        {
            return;
        }

        Ecrire("Vous levez votre bouclier.");
        Riposte(Joueur.Defense * 2);
        if (!EstTermine)
        {
            FrapperAdversaire(1);
        }
        _db.SaveChanges();
    }

    private void FrapperAdversaire(int coup)
    {
        var monstre = Adversaire!;
        VieAdversaire = Math.Max(0, VieAdversaire - coup);
        Ecrire($"Vous frappez {monstre.Nom} : -{coup} (vie restante : {VieAdversaire}).");

        if (VieAdversaire == 0)
        {
            Ecrire($"{monstre.Nom} est vaincu !");
            Adversaire = null;
        }
    }

    private void Riposte(int defense)
    {
        var monstre = Adversaire!;
        int coup = Math.Max(0, monstre.Attaque + _hasard.Next(BONUS_MAX) - defense);
        Ecrire($"{monstre.Nom} vous frappe : -{coup}.");
        ChangerVie(-coup);
    }

    // ---------------------------------------------------------------------
    // Outils
    // ---------------------------------------------------------------------

    private void ChangerVie(int points)
    {
        Joueur.Vie = Math.Clamp(Joueur.Vie + points, 0, Joueur.VieMax);
        Ecrire(points >= 0 ? $"Vie +{points}." : $"Vie {points}.");

        if (Joueur.Vie == 0)
        {
            Terminer("Vous êtes mort. Le donjon a gagné...");
        }
    }

    private void Terminer(string message)
    {
        Ecrire(message);
        Adversaire = null;
        EstTermine = true;
    }

    public void Recommencer()
    {
        Joueur.Vie = Joueur.VieMax;
        Adversaire = null;
        EstTermine = false;
        _db.SaveChanges();
        Ecrire("--- Nouvelle partie ---");
    }

    /// <summary>Ajoute une ligne au journal (public : la fenêtre peut aussi écrire).</summary>
    public void Ecrire(string message) => _journal.Add(message);
}
