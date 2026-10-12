namespace Sample.Modeles;

/// <summary>Table Inventaire : une ligne par sorte d'objet porté par le héros.</summary>
public class ObjetInventaire
{
    public int Id { get; set; }
    public string Nom { get; set; } = "";
    public int Quantite { get; set; }
}
