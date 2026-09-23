using Microsoft.EntityFrameworkCore.Metadata;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

#pragma warning disable CA1814 // Prefer jagged arrays over multidimensional

namespace Sample.Migrations
{
    /// <inheritdoc />
    public partial class init : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AlterDatabase()
                .Annotation("MySql:CharSet", "utf8mb4");

            migrationBuilder.CreateTable(
                name: "EtatJoueur",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("MySql:ValueGenerationStrategy", MySqlValueGenerationStrategy.IdentityColumn),
                    Nom = table.Column<string>(type: "longtext", nullable: false)
                        .Annotation("MySql:CharSet", "utf8mb4"),
                    Vie = table.Column<int>(type: "int", nullable: false),
                    VieMax = table.Column<int>(type: "int", nullable: false),
                    Force = table.Column<int>(type: "int", nullable: false),
                    Defense = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_EtatJoueur", x => x.Id);
                })
                .Annotation("MySql:CharSet", "utf8mb4");

            migrationBuilder.CreateTable(
                name: "Evenements",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("MySql:ValueGenerationStrategy", MySqlValueGenerationStrategy.IdentityColumn),
                    Nom = table.Column<string>(type: "longtext", nullable: false)
                        .Annotation("MySql:CharSet", "utf8mb4"),
                    Type = table.Column<string>(type: "varchar(20)", maxLength: 20, nullable: false)
                        .Annotation("MySql:CharSet", "utf8mb4"),
                    Description = table.Column<string>(type: "longtext", nullable: false)
                        .Annotation("MySql:CharSet", "utf8mb4"),
                    Degats = table.Column<int>(type: "int", nullable: false),
                    Objet = table.Column<string>(type: "longtext", nullable: true)
                        .Annotation("MySql:CharSet", "utf8mb4")
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Evenements", x => x.Id);
                })
                .Annotation("MySql:CharSet", "utf8mb4");

            migrationBuilder.CreateTable(
                name: "Inventaire",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("MySql:ValueGenerationStrategy", MySqlValueGenerationStrategy.IdentityColumn),
                    Nom = table.Column<string>(type: "longtext", nullable: false)
                        .Annotation("MySql:CharSet", "utf8mb4"),
                    Quantite = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Inventaire", x => x.Id);
                })
                .Annotation("MySql:CharSet", "utf8mb4");

            migrationBuilder.CreateTable(
                name: "Monstres",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("MySql:ValueGenerationStrategy", MySqlValueGenerationStrategy.IdentityColumn),
                    Nom = table.Column<string>(type: "longtext", nullable: false)
                        .Annotation("MySql:CharSet", "utf8mb4"),
                    Attaque = table.Column<int>(type: "int", nullable: false),
                    Vie = table.Column<int>(type: "int", nullable: false),
                    Defense = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Monstres", x => x.Id);
                })
                .Annotation("MySql:CharSet", "utf8mb4");

            migrationBuilder.InsertData(
                table: "EtatJoueur",
                columns: new[] { "Id", "Defense", "Force", "Nom", "Vie", "VieMax" },
                values: new object[] { 1, 2, 5, "Héros", 20, 20 });

            migrationBuilder.InsertData(
                table: "Evenements",
                columns: new[] { "Id", "Degats", "Description", "Nom", "Objet", "Type" },
                values: new object[,]
                {
                    { 1, 0, "Un couloir humide et silencieux. Rien à signaler.", "Couloir vide", null, "Rien" },
                    { 2, 0, "Des toiles d'araignée et un vieux tabouret. Rien d'utile.", "Salle abandonnée", null, "Rien" },
                    { 3, 0, "Un grognement résonne : un monstre surgit de l'ombre !", "Rencontre", null, "Monstre" },
                    { 4, 0, "Quelque chose vous attaque par derrière !", "Embuscade", null, "Monstre" },
                    { 5, 4, "Le sol se dérobe sur des pointes rouillées.", "Piège à pointes", null, "Piege" },
                    { 6, 2, "Une fléchette jaillit du mur.", "Fléchette", null, "Piege" },
                    { 7, -6, "Une eau claire et scintillante. Vous vous sentez mieux.", "Fontaine de santé", null, "Fontaine" },
                    { 8, 0, "Un petit coffre entrouvert.", "Coffre", "Ration", "Objet" },
                    { 9, 0, "Une arme pend au mur.", "Râtelier", "Épée", "Objet" },
                    { 10, 0, "Un courant d'air frais... La sortie du donjon !", "Sortie", null, "Sortie" }
                });

            migrationBuilder.InsertData(
                table: "Inventaire",
                columns: new[] { "Id", "Nom", "Quantite" },
                values: new object[,]
                {
                    { 1, "Ration", 2 },
                    { 2, "Torche", 1 }
                });

            migrationBuilder.InsertData(
                table: "Monstres",
                columns: new[] { "Id", "Attaque", "Defense", "Nom", "Vie" },
                values: new object[,]
                {
                    { 1, 3, 0, "Rat géant", 4 },
                    { 2, 4, 1, "Gobelin", 7 },
                    { 3, 5, 1, "Squelette", 9 },
                    { 4, 6, 2, "Orc", 12 }
                });
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "EtatJoueur");

            migrationBuilder.DropTable(
                name: "Evenements");

            migrationBuilder.DropTable(
                name: "Inventaire");

            migrationBuilder.DropTable(
                name: "Monstres");
        }
    }
}
