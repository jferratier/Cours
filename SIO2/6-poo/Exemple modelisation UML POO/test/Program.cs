using test;

Immatriculation immat1 = new Immatriculation("VF1ABC123456", "AB-123-CD");
Voiture voiture1 = new Voiture("Peugeot 208", immat1);
voiture1.Afficher();

Console.WriteLine();
Console.WriteLine();
Console.WriteLine();

Immatriculation immatesla = new Immatriculation("SDFSDF", "xy-123-zz");
VoitureElectrique tesla = new VoitureElectrique("Tesla Model 3", immatesla, 530);
tesla.Afficher();

Console.WriteLine();
Console.WriteLine();
Console.WriteLine();
