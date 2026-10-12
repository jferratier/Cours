using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace test
{
    public class Piece
    {
        private string roue;
        private string plaquetteFrein;
        private string disque;

        public string getRoue()
        {
            return roue;
        }
        public string getPlaquetteFrein()
        {
            return plaquetteFrein;
        }
        public string getDisque()
        {
            return disque;
        }

        public Piece(string roue, string plaquetteFrein, string disque)
        {
            this.roue = roue;
            this.plaquetteFrein = plaquetteFrein;
            this.disque = disque;
        }

    }
}
