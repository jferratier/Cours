using Sample.Donnees;
using Sample.Migrations;
using Sample.Modeles;
using System.Security.Cryptography;

namespace Sample.Jeu;

/// <summary>
/// Les règles du jeu. La fenêtre appelle ces méthodes, puis relit l'état pour l'afficher.
/// Tout ce qui change (la vie du héros) est enregistré en base par Entity Framework.
/// </summary>
public class Jeux
{

    public string NomEpreuve { get; }
   
    private readonly SampleContext _db = new();
    private readonly Random _hasard = new();
    private readonly List<string> _journal = new();

    private int _idEpreuve = 0;



    public IReadOnlyList<string> Journal => _journal;

    public Jeux()
    {
        //LINQ affichage nom de l'epreuve

        var uneEpreuve = _db.Epreuves.First();
        _idEpreuve = uneEpreuve.Id;

        NomEpreuve = uneEpreuve.Nom.ToString();

        var listeParticipants = _db.Participant
            .Select(c => new { c.Id,  c.Nom, c.niveauForme , c.niveauForce, c.niveauIntelligence, c.niveauEndurance })
            .ToList();



        foreach (var l in listeParticipants)
            Ecrire($"{l.Id} -> {l.Nom} : Forme({l.niveauForme}) Force({l.niveauForce}) Intelligence({l.niveauIntelligence}) Endurance({l.niveauEndurance}) ");

        Ecrire($" Quel participant voulez vous envoyer sur l'epreuve ? ");

        Ecrire($" l'epreuve sera {uneEpreuve.Nom}, elle nécéssitera un niveau de force de {uneEpreuve.niveauForce} ");

    }


    public int LancerEpreuve(int idParticipant)
    {
        var participantChoisi = _db.Participant
            .Where(c=> c.Id == idParticipant)
            .ToList();

        var epreuveEnCours = _db.Epreuves
            .Where(c => c.Id == _idEpreuve)
            .ToList();

        if (epreuveEnCours.First().Id != null)
            if (epreuveEnCours.First().niveauForce <= participantChoisi.First().niveauForce)
            {
                Ecrire($"Le participant  {participantChoisi.First().Nom.ToString()} à reussi l'epreuve  :( "); return 1;
            }
            else
            {
                Ecrire($"Le participant  {participantChoisi.First().Nom.ToString()} n'a pas reussi l'epreuve ! Domage !"); return 0;
            }

        return 0;
    }


    // ---------------------------------------------------------------------
    // Explorer : l'algorithme 
    // ---------------------------------------------------------------------



        /// <summary>Ajoute une ligne au journal (public : la fenêtre peut aussi écrire).</summary>
    public void Ecrire(string message) => _journal.Add(message);
}
