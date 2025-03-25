<?php
namespace App\Models;
use App\Models\SqlDatabase;


class OfferModel extends Model {
    const ACCEPTED_STATUS = "Accepted";
    const REJECTED_STATUS = "Rejected";
    const PENDING_STATUS = "Pending";
    const REMOVED_STATUS = "Removed";

    private SqlDatabase $db;

    public function __construct()
    {
        $this->db = new SqlDatabase('offres_stage'); 
    }

    public function getAllOffers(): array
    {
        return $this->db->getAllRecords();
    }

    public function getOfferById(int $id): ?array
    {
        return $this->db->getRecord($id);
    }

    public function addOffer(array $offer): int
    {
        return $this->db->insertRecord($offer);
    }

    public function updateOffer(int $id, array $offer): bool
    {
        return $this->db->updateRecord($id, $offer);
    }

    public function deleteOfferById(int $id): bool
    {
        $offer = $this->getOfferById($id);
        return $offer ? $this->db->deleteRecord($offer) : false;
    }
}
