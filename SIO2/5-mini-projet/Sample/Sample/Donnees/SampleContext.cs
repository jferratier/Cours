using Microsoft.EntityFrameworkCore;
using Sample.Modeles;

namespace Sample.Donnees;

/// <summary>
/// Le lien entre le C# et la base MySQL <c>sample</c>.
/// Chaque DbSet est une table ; chaque objet d'un DbSet est une ligne.
/// </summary>
public class SampleContext : DbContext
{
    public DbSet<Evenement> Evenements => Set<Evenement>();
    public DbSet<Monstre> Monstres => Set<Monstre>();
    public DbSet<EtatJoueur> EtatJoueur => Set<EtatJoueur>();
    public DbSet<ObjetInventaire> Inventaire => Set<ObjetInventaire>();

    // WampServer : utilisateur root, mot de passe vide (poste de développement uniquement).
    public const string Chaine = "server=localhost;port=3306;database=sample;user=root;password=";

    protected override void OnConfiguring(DbContextOptionsBuilder options) =>
        options.UseMySql(Chaine, ServerVersion.AutoDetect(Chaine));

    protected override void OnModelCreating(ModelBuilder mb)
    {
        // Le type est rangé en texte ("Monstre") plutôt qu'en nombre : plus lisible en SQL.
        mb.Entity<Evenement>().Property(e => e.Type).HasConversion<string>().HasMaxLength(20);

        // ---- Les lignes de départ, insérées par la migration (Update-Database) ----

        mb.Entity<Evenement>().HasData(
            new Evenement { Id = 1, Nom = "Couloir vide", Type = TypeEvenement.Rien, Description = "Un couloir humide et silencieux. Rien à signaler." },
            new Evenement { Id = 2, Nom = "Salle abandonnée", Type = TypeEvenement.Rien, Description = "Des toiles d'araignée et un vieux tabouret. Rien d'utile." },
            new Evenement { Id = 3, Nom = "Rencontre", Type = TypeEvenement.Monstre, Description = "Un grognement résonne : un monstre surgit de l'ombre !" },
            new Evenement { Id = 4, Nom = "Embuscade", Type = TypeEvenement.Monstre, Description = "Quelque chose vous attaque par derrière !" },
            new Evenement { Id = 5, Nom = "Piège à pointes", Type = TypeEvenement.Piege, Description = "Le sol se dérobe sur des pointes rouillées.", Degats = 4 },
            new Evenement { Id = 6, Nom = "Fléchette", Type = TypeEvenement.Piege, Description = "Une fléchette jaillit du mur.", Degats = 2 },
            new Evenement { Id = 7, Nom = "Fontaine de santé", Type = TypeEvenement.Fontaine, Description = "Une eau claire et scintillante. Vous vous sentez mieux.", Degats = -6 },
            new Evenement { Id = 8, Nom = "Coffre", Type = TypeEvenement.Objet, Description = "Un petit coffre entrouvert.", Objet = "Ration" },
            new Evenement { Id = 9, Nom = "Râtelier", Type = TypeEvenement.Objet, Description = "Une arme pend au mur.", Objet = "Épée" },
            new Evenement { Id = 10, Nom = "Sortie", Type = TypeEvenement.Sortie, Description = "Un courant d'air frais... La sortie du donjon !" });

        mb.Entity<Monstre>().HasData(
            new Monstre { Id = 1, Nom = "Rat géant", Attaque = 3, Vie = 4, Defense = 0 },
            new Monstre { Id = 2, Nom = "Gobelin", Attaque = 4, Vie = 7, Defense = 1 },
            new Monstre { Id = 3, Nom = "Squelette", Attaque = 5, Vie = 9, Defense = 1 },
            new Monstre { Id = 4, Nom = "Orc", Attaque = 6, Vie = 12, Defense = 2 });

        mb.Entity<EtatJoueur>().HasData(
            new EtatJoueur { Id = 1, Nom = "Héros", Vie = 20, VieMax = 20, Force = 5, Defense = 2 });

        mb.Entity<ObjetInventaire>().HasData(
            new ObjetInventaire { Id = 1, Nom = "Ration", Quantite = 2 },
            new ObjetInventaire { Id = 2, Nom = "Torche", Quantite = 1 });
    }
}
