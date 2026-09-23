namespace Sample.Modeles;

/// <summary>Table EtatJoueur : une seule ligne, le héros. Chaque action la met à jour en base.</summary>
public class EtatJoueur
{
    public int Id { get; set; }
    public string Nom { get; set; } = "";
    public int Vie { get; set; }
    public int VieMax { get; set; }
    public int Force { get; set; }
    public int Defense { get; set; }
}
