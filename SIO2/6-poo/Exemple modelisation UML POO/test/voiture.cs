using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace test
{
    public class Voiture
    {
        private string nomVoiture;
        private List<Piece> pieces;     // composition 
        private Immatriculation immat; // agregation 

        public Voiture(string nomVoiture, Immatriculation immat)
        {
            this.nomVoiture = nomVoiture;
            this.immat = immat;

            this.pieces = new List<Piece>
            {
                new Piece("Roues avant gauche",  "Plaquettes avant standard", "Disque avant simple "),
                new Piece("Roues arrière gauche", "Plaquettes arriere sport", "Disque arriere sport"),
            };
        }

        public void ChangerImmatriculation(Immatriculation nouvelle)
        {
            this.immat = nouvelle;
        }

        public virtual void Afficher()
        {
            string immatTexte = "";
            immatTexte = this.immat.getNumeroImmatriculation();

            Console.WriteLine($"Voiture : {nomVoiture}");
            Console.WriteLine($"Immatriculation : {immatTexte}");
            Console.WriteLine($"Nombre de pièces : {pieces.Count}");
            foreach (Piece p in pieces)
            {
                Console.WriteLine($" Roue : {p.getRoue()}");
                Console.WriteLine($" Plaquettes : {p.getPlaquetteFrein()}");
                Console.WriteLine($" Disque : {p.getDisque()}");
            }
        }
    }
}
