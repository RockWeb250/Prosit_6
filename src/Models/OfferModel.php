<?php
namespace App\Models;

class OfferModel extends Model {
    // Définition des statuts en anglais
    const ACCEPTED_STATUS = "Accepted";
    const REJECTED_STATUS = "Rejected";
    const PENDING_STATUS = "Pending";

    public function __construct($connection = null) {
        if (is_null($connection)) {
            // Mise à jour pour correspondre aux clés du CSV
            $this->connection = new FileDatabase('offers', ['offer', 'status']);
        } else {
            $this->connection = $connection;
        }
    }

    public function getAllOffers() {
        return $this->connection->getAllRecords();
    }

    public function getOffer($id) {
        return $this->connection->getRecord($id);
    }
    
    public function acceptedOffer() {
        $data = [];
        foreach ($this->getAllOffers() as $offer) {
            if ($offer['status'] === self::ACCEPTED_STATUS) {
                $data[] = $offer;
            }
        }
        return $data;
    }

    public function rejectedOffer() {
        $data = [];
        foreach ($this->getAllOffers() as $offer) {
            if ($offer['status'] === self::REJECTED_STATUS) {
                $data[] = $offer;
            }
        }
        return $data;
    }

    public function pendingOffer(): array {
        $data = [];
        foreach ($this->getAllOffers() as $offer) {
            if ($offer['status'] === self::PENDING_STATUS) {
                $data[] = $offer;
            }
        }
        return $data;
    }

    public function addOffer($offer) {
        $record = ['offer' => $offer, 'status' => self::PENDING_STATUS];
        $this->connection->insertRecord($record);
        return $this;
    }
}
?>