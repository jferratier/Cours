namespace Sample.Modeles;

/// <summary>Table EtatJoueur : une seule ligne, le héros. Chaque action la met à jour en base.</summary>
public class Participant
{
    public int Id { get; set; }
    public string Nom { get; set; } = "";
    public int niveauEndurance { get; set; }
    public int niveauIntelligence { get; set; }
    public int niveauForce { get; set; }
    public int niveauForme { get; set; }
}
