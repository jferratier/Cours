using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace test
{
    public class Immatriculation
    {
        private string numSerie;
        private string numeroImmatriculation;

        public string getNumSerie()
        {
            return numSerie;
        }

        public string getNumeroImmatriculation()
        {
            return numeroImmatriculation;
        }

        public Immatriculation(string numSerie, string numeroImmatriculation)
        {
            this.numSerie = numSerie;
            this.numeroImmatriculation = numeroImmatriculation;
        }

    }
}
