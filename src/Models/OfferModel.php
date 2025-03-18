<?php
namespace App\Models;

class OfferModel extends Model {
    const ACCEPTED_STATUS = "Accepted";
    const REJECTED_STATUS = "Rejected";
    const PENDING_STATUS = "Pending";
    const REMOVED_STATUS = "Removed";

    public function __construct($connection = null) {
        if (is_null($connection)) {
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

    public function removeOffer($offer) {
        $record = ['offer' => $offer, 'status' => self::REMOVED_STATUS];
        $this->connection->deleteRecord($record);
        return $this;
    }
}
?>