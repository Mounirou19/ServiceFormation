<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250227132801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appel_fonds (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, date_appel DATETIME NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_2A118182166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, siren VARCHAR(9) NOT NULL, iban VARCHAR(34) NOT NULL, adresse VARCHAR(255) NOT NULL, contact_facturation VARCHAR(255) NOT NULL, commission DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_C7440455DB8BBA08 (siren), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, organisme VARCHAR(255) NOT NULL, cout_ht DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, date_formation DATETIME NOT NULL, INDEX IDX_404021BF613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, name VARCHAR(255) NOT NULL, budget_initial DOUBLE PRECISION NOT NULL, seuil_alerte DOUBLE PRECISION NOT NULL, liste_diffusion JSON NOT NULL, INDEX IDX_2FB3D0EE19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, cout_total DOUBLE PRECISION NOT NULL, INDEX IDX_D044D5D4166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appel_fonds ADD CONSTRAINT FK_2A118182166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appel_fonds DROP FOREIGN KEY FK_2A118182166D1F9C');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF613FECDF');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE19EB6921');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4166D1F9C');
        $this->addSql('DROP TABLE appel_fonds');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE user');
    }
}
