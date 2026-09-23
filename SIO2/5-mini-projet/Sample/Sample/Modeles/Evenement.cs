namespace Sample.Modeles;

/// <summary>Les sortes d'événements. Enregistré en base sous forme de texte ("Monstre", "Piege"...).</summary>
public enum TypeEvenement
{
    Rien,
    Monstre,
    Piege,
    Fontaine,
    Objet,
    Sortie
}

/// <summary>Table Evenements : ce qui peut arriver quand on explore.</summary>
public class Evenement
{
    public int Id { get; set; }
    public string Nom { get; set; } = "";
    public TypeEvenement Type { get; set; }
    public string Description { get; set; } = "";

    /// <summary>Points de vie perdus. Négatif = points de vie gagnés (une fontaine).</summary>
    public int Degats { get; set; }

    /// <summary>L'objet trouvé, pour un événement de type Objet (sinon vide).</summary>
    public string? Objet { get; set; }
}
