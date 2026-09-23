using System.Windows;
using System.Windows.Threading;

namespace Sample;

public partial class App : Application
{
    // Dernier filet de sécurité : une erreur imprévue affiche un message au lieu de fermer le jeu.
    private void App_DispatcherUnhandledException(object sender, DispatcherUnhandledExceptionEventArgs e)
    {
        MessageBox.Show($"Erreur : {e.Exception.Message}", "Sample", MessageBoxButton.OK, MessageBoxImage.Error);
        e.Handled = true;
    }
}
