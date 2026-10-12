namespace Sample.Modeles;

/// <summary>Table Monstres : les monstres que l'on peut rencontrer.</summary>
public class Monstre
{
    public int Id { get; set; }
    public string Nom { get; set; } = "";
    public int Attaque { get; set; }
    public int Vie { get; set; }
    public int Defense { get; set; }
}
