using System.Windows;
using Sample.Jeu;

namespace Sample;

/// <summary>
/// La fenêtre : elle transmet les clics au Donjon, puis affiche son état.
/// Aucune règle ici.
/// </summary>
public partial class MainWindow : Window
{
    private Donjon? _donjon;   // null si la base n'a pas pu être lue

    public MainWindow()
    {
        InitializeComponent();
    }

    private void Fenetre_Loaded(object sender, RoutedEventArgs e)
    {
        try
        {
            _donjon = new Donjon();
            Rafraichir();
        }
        catch (Exception ex)
        {
            MessageBox.Show("Impossible de lire la base de données.\n"
                            + "WampServer est-il démarré ? Avez-vous lancé Update-Database ?\n\n" + ex.Message,
                "Sample", MessageBoxButton.OK, MessageBoxImage.Error);
            Close();
        }
    }

    // ---------------------------------------------------------------------
    // Les boutons codés
    // ---------------------------------------------------------------------

    private void BoutonExplorer_Click(object sender, RoutedEventArgs e) => Jouer(d => d.Explorer());

    private void BoutonAttaquer_Click(object sender, RoutedEventArgs e) => Jouer(d => d.Attaquer());

    private void BoutonDefendre_Click(object sender, RoutedEventArgs e) => Jouer(d => d.Defendre());

    private void BoutonRecommencer_Click(object sender, RoutedEventArgs e) => Jouer(d => d.Recommencer());

    // ---------------------------------------------------------------------
    // À CODER (étudiants) : écrire la règle dans Donjon, puis l'appeler ici
    // ---------------------------------------------------------------------

    private void BoutonManger_Click(object sender, RoutedEventArgs e) =>
        Jouer(d => d.Ecrire("Manger : action pas encore codée."));

    private void BoutonDormir_Click(object sender, RoutedEventArgs e) =>
        Jouer(d => d.Ecrire("Dormir : action pas encore codée."));

    private void BoutonRamasser_Click(object sender, RoutedEventArgs e) =>
        Jouer(d => d.Ecrire("Ramasser : action pas encore codée."));

    // ---------------------------------------------------------------------
    // L'affichage
    // ---------------------------------------------------------------------

    private void Jouer(Action<Donjon> action)
    {
        if (_donjon != null)
        {
            action(_donjon);
            Rafraichir();
        }
    }

    private void Rafraichir()
    {
        var donjon = _donjon!;
        var joueur = donjon.Joueur;

        // La fiche du personnage.
        TexteNom.Text = joueur.Nom;
        TexteVie.Text = $"Vie {joueur.Vie} / {joueur.VieMax}";
        BarreVie.Maximum = joueur.VieMax;
        BarreVie.Value = joueur.Vie;
        TexteCaracteristiques.Text = $"Attaque {joueur.Force}    Défense {joueur.Defense}";
        ImageHeros.Opacity = joueur.Vie > 0 ? 1.0 : 0.3;

        // Le sac : une ligne LINQ transforme la liste d'objets en texte.
        var sac = donjon.Inventaire().Select(o => $"{o.Nom} x{o.Quantite}");
        TexteSac.Text = "Sac : " + string.Join(", ", sac);

        TexteAdversaire.Text = donjon.Adversaire is { } monstre
            ? $"Combat : {monstre.Nom}, vie {donjon.VieAdversaire} / {monstre.Vie}"
            : "";

        // Les boutons utilisables selon la situation.
        BoutonExplorer.IsEnabled = !donjon.EnCombat && !donjon.EstTermine;
        BoutonAttaquer.IsEnabled = donjon.EnCombat;
        BoutonDefendre.IsEnabled = donjon.EnCombat;

        // Le journal, le plus récent en haut.
        ListeJournal.ItemsSource = donjon.Journal.Reverse().ToList();
    }
}
