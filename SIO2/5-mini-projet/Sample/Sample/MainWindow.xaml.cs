using Sample.Jeu;
using System.Windows;
using System.Windows.Media.Imaging;

namespace Sample;

/// <summary>
/// La fenêtre : elle transmet les clics au Jeux, puis affiche son état.
/// Aucune règle ici.
/// </summary>
public partial class MainWindow : Window
{
    private Jeux? _jeux;   // null si la base n'a pas pu être lue

    public MainWindow()
    {
        InitializeComponent();
    }

    private void Fenetre_Loaded(object sender, RoutedEventArgs e)
    {
        try
        { 
            _jeux = new Jeux();
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
    // L'affichage
    // ---------------------------------------------------------------------


    private void tirerEpreuve()
    {
        var jeux = _jeux;
        var monNomEpreuve = _jeux.NomEpreuve;

        // La fiche du personnage.
        TexteNom.Text = monNomEpreuve;
        TexteCaracteristiques.Text = $"";

 
        // Le journal, le plus récent en haut.
        ListeJournal.ItemsSource = jeux.Journal.Reverse().ToList();
    }

    
    private void ButtonEpreuve_Click(object sender, RoutedEventArgs e)
    {

        tirerEpreuve();

    }

    private void ButtonLancerEpreuve_Click(object sender, RoutedEventArgs e)
    {
        int resultat = _jeux.LancerEpreuve(int.Parse(nomChoix.Text));

        if (resultat == 0)
        {
            ImageJeux0.Source = new BitmapImage(
           new Uri(@"Images/croix.png", UriKind.Relative));
        }
        else
        {
            ImageJeux0.Source = new BitmapImage(
            new Uri(@"Images/succes.png", UriKind.Relative));
        }

        //On actualise le journal
        ListeJournal.ItemsSource = _jeux.Journal.Reverse().ToList();
    }

   
}
