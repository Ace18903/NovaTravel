<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250322223416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event CHANGE id id INT NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE date_event date_event VARCHAR(255) NOT NULL, CHANGE duree duree INT NOT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE hebergement CHANGE id id INT NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE planning CHANGE id id INT NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE planning_events DROP FOREIGN KEY planning_events_ibfk_2');
        $this->addSql('DROP INDEX id_event ON planning_events');
        $this->addSql('CREATE INDEX IDX_33A67525D52B4B97 ON planning_events (id_event)');
        $this->addSql('ALTER TABLE planning_events ADD CONSTRAINT planning_events_ibfk_2 FOREIGN KEY (id_event) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_1');
        $this->addSql('ALTER TABLE reclamation CHANGE id id INT NOT NULL, CHANGE id_user id_user INT DEFAULT NULL');
        $this->addSql('DROP INDEX id_user ON reclamation');
        $this->addSql('CREATE INDEX IDX_CE6064046B3CA4B ON reclamation (id_user)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_1 FOREIGN KEY (id_user) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY reponse_ibfk_1');
        $this->addSql('ALTER TABLE reponse CHANGE id id INT NOT NULL, CHANGE id_reclamation id_reclamation INT DEFAULT NULL');
        $this->addSql('DROP INDEX id_reclamation ON reponse');
        $this->addSql('CREATE INDEX IDX_5FB6DEC7D672A9F3 ON reponse (id_reclamation)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT reponse_ibfk_1 FOREIGN KEY (id_reclamation) REFERENCES reclamation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_hebergement DROP FOREIGN KEY reservation_hebergement_ibfk_1');
        $this->addSql('ALTER TABLE reservation_hebergement DROP FOREIGN KEY reservation_hebergement_ibfk_2');
        $this->addSql('ALTER TABLE reservation_hebergement CHANGE id id INT NOT NULL, CHANGE id_user id_user INT DEFAULT NULL, CHANGE id_hebergement id_hebergement INT DEFAULT NULL');
        $this->addSql('DROP INDEX id_user ON reservation_hebergement');
        $this->addSql('CREATE INDEX IDX_843E00C06B3CA4B ON reservation_hebergement (id_user)');
        $this->addSql('DROP INDEX id_hebergement ON reservation_hebergement');
        $this->addSql('CREATE INDEX IDX_843E00C05040106B ON reservation_hebergement (id_hebergement)');
        $this->addSql('ALTER TABLE reservation_hebergement ADD CONSTRAINT reservation_hebergement_ibfk_1 FOREIGN KEY (id_user) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_hebergement ADD CONSTRAINT reservation_hebergement_ibfk_2 FOREIGN KEY (id_hebergement) REFERENCES hebergement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_vol DROP FOREIGN KEY reservation_vol_ibfk_1');
        $this->addSql('ALTER TABLE reservation_vol DROP FOREIGN KEY reservation_vol_ibfk_2');
        $this->addSql('ALTER TABLE reservation_vol CHANGE id id INT NOT NULL, CHANGE id_user id_user INT DEFAULT NULL, CHANGE id_vol id_vol INT DEFAULT NULL');
        $this->addSql('DROP INDEX id_user ON reservation_vol');
        $this->addSql('CREATE INDEX IDX_5C5EBA346B3CA4B ON reservation_vol (id_user)');
        $this->addSql('DROP INDEX id_vol ON reservation_vol');
        $this->addSql('CREATE INDEX IDX_5C5EBA3497F87FB1 ON reservation_vol (id_vol)');
        $this->addSql('ALTER TABLE reservation_vol ADD CONSTRAINT reservation_vol_ibfk_1 FOREIGN KEY (id_user) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_vol ADD CONSTRAINT reservation_vol_ibfk_2 FOREIGN KEY (id_vol) REFERENCES vol (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX cin ON user');
        $this->addSql('ALTER TABLE user CHANGE id id INT NOT NULL, CHANGE tel tel INT NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vol CHANGE id id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE description description TEXT DEFAULT NULL, CHANGE date_event date_event VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE duree duree INT DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE hebergement CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE photo photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE planning CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE nom nom VARCHAR(255) DEFAULT \'Default Name\' NOT NULL');
        $this->addSql('ALTER TABLE planning_events DROP FOREIGN KEY FK_33A67525D52B4B97');
        $this->addSql('DROP INDEX idx_33a67525d52b4b97 ON planning_events');
        $this->addSql('CREATE INDEX id_event ON planning_events (id_event)');
        $this->addSql('ALTER TABLE planning_events ADD CONSTRAINT FK_33A67525D52B4B97 FOREIGN KEY (id_event) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE6064046B3CA4B');
        $this->addSql('ALTER TABLE reclamation CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE id_user id_user INT NOT NULL');
        $this->addSql('DROP INDEX idx_ce6064046b3ca4b ON reclamation');
        $this->addSql('CREATE INDEX id_user ON reclamation (id_user)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE6064046B3CA4B FOREIGN KEY (id_user) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7D672A9F3');
        $this->addSql('ALTER TABLE reponse CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE id_reclamation id_reclamation INT NOT NULL');
        $this->addSql('DROP INDEX idx_5fb6dec7d672a9f3 ON reponse');
        $this->addSql('CREATE INDEX id_reclamation ON reponse (id_reclamation)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7D672A9F3 FOREIGN KEY (id_reclamation) REFERENCES reclamation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_hebergement DROP FOREIGN KEY FK_843E00C06B3CA4B');
        $this->addSql('ALTER TABLE reservation_hebergement DROP FOREIGN KEY FK_843E00C05040106B');
        $this->addSql('ALTER TABLE reservation_hebergement CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE id_user id_user INT NOT NULL, CHANGE id_hebergement id_hebergement INT NOT NULL');
        $this->addSql('DROP INDEX idx_843e00c06b3ca4b ON reservation_hebergement');
        $this->addSql('CREATE INDEX id_user ON reservation_hebergement (id_user)');
        $this->addSql('DROP INDEX idx_843e00c05040106b ON reservation_hebergement');
        $this->addSql('CREATE INDEX id_hebergement ON reservation_hebergement (id_hebergement)');
        $this->addSql('ALTER TABLE reservation_hebergement ADD CONSTRAINT FK_843E00C06B3CA4B FOREIGN KEY (id_user) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_hebergement ADD CONSTRAINT FK_843E00C05040106B FOREIGN KEY (id_hebergement) REFERENCES hebergement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_vol DROP FOREIGN KEY FK_5C5EBA346B3CA4B');
        $this->addSql('ALTER TABLE reservation_vol DROP FOREIGN KEY FK_5C5EBA3497F87FB1');
        $this->addSql('ALTER TABLE reservation_vol CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE id_user id_user INT NOT NULL, CHANGE id_vol id_vol INT NOT NULL');
        $this->addSql('DROP INDEX idx_5c5eba346b3ca4b ON reservation_vol');
        $this->addSql('CREATE INDEX id_user ON reservation_vol (id_user)');
        $this->addSql('DROP INDEX idx_5c5eba3497f87fb1 ON reservation_vol');
        $this->addSql('CREATE INDEX id_vol ON reservation_vol (id_vol)');
        $this->addSql('ALTER TABLE reservation_vol ADD CONSTRAINT FK_5C5EBA346B3CA4B FOREIGN KEY (id_user) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_vol ADD CONSTRAINT FK_5C5EBA3497F87FB1 FOREIGN KEY (id_vol) REFERENCES vol (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE tel tel INT DEFAULT NULL, CHANGE mail mail VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX cin ON user (cin)');
        $this->addSql('ALTER TABLE vol CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
