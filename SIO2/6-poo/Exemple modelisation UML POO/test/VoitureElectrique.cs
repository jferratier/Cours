using System;

namespace test
{
    // Héritage : une voiture électrique est une voiture avec une autonomie
    public class VoitureElectrique : Voiture
    {
        private string nomVoiture;
        private string immat;
        private int autonomieKm;

        public VoitureElectrique(string nomVoiture, Immatriculation immat, int autonomieKm)
            : base(nomVoiture, immat)
        {
            this.autonomieKm = autonomieKm;
            this.nomVoiture = nomVoiture;
            this.immat = immat.getNumeroImmatriculation();
        }

        public override void Afficher()
        {
            Console.WriteLine($"Nom : {nomVoiture}, Immat : {immat},  Autonomie : {autonomieKm} km");
        }
    }
}
