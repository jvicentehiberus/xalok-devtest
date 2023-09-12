<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230911212843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, uuid BIGINT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, license VARCHAR(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip_vehicle (trip_id INT NOT NULL, vehicle_id INT NOT NULL, INDEX IDX_2D6CA12BA5BC2E0E (trip_id), INDEX IDX_2D6CA12B545317D1 (vehicle_id), PRIMARY KEY(trip_id, vehicle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip_driver (trip_id INT NOT NULL, driver_id INT NOT NULL, INDEX IDX_FE692773A5BC2E0E (trip_id), INDEX IDX_FE692773C3423909 (driver_id), PRIMARY KEY(trip_id, driver_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, uuid BIGINT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, plate VARCHAR(255) NOT NULL, license_required VARCHAR(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trip_vehicle ADD CONSTRAINT FK_2D6CA12BA5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip_vehicle ADD CONSTRAINT FK_2D6CA12B545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip_driver ADD CONSTRAINT FK_FE692773A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip_driver ADD CONSTRAINT FK_FE692773C3423909 FOREIGN KEY (driver_id) REFERENCES driver (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trip_vehicle DROP FOREIGN KEY FK_2D6CA12BA5BC2E0E');
        $this->addSql('ALTER TABLE trip_vehicle DROP FOREIGN KEY FK_2D6CA12B545317D1');
        $this->addSql('ALTER TABLE trip_driver DROP FOREIGN KEY FK_FE692773A5BC2E0E');
        $this->addSql('ALTER TABLE trip_driver DROP FOREIGN KEY FK_FE692773C3423909');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP TABLE trip');
        $this->addSql('DROP TABLE trip_vehicle');
        $this->addSql('DROP TABLE trip_driver');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
