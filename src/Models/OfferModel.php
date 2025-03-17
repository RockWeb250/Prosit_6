<?php
namespace App\Models;

class OfferModel extends Model {
    const TODO_STATUS = "todo";
    const DONE_STATUS = "done";

    /**
     * TaskModel constructor.
     * 
     * @param mixed $connection The database connection. If null, a new FileDatabase connection will be created.
     */
    public function __construct($connection = null) {
        if(is_null($connection)) {
            $this->connection = new FileDatabase('offers', ['offer', 'status']);
        } else {
            $this->connection = $connection;
        }
    }

    /**
     * Get all tasks from the model.
     * 
     * @return array An array of all tasks.
     */
    public function getAllOffers() {
        // Call the getAllRecords method of the connection property
        $offers = $this->connection->getAllRecords();
        return $offers;
    }

    /**
     * Get a specific task by its ID.
     * 
     * @param int $id The ID of the task.
     * @return mixed The task with the specified ID.
     */
    public function getOffer($id) {
        // It's the same as the getAllTasks method, but we only return the task with the specified id
        $offer = $this->connection->getRecord($id);
        return $offer;
    }
    
    /**
     * 
     * @return array An array of offers with the status 'done'.
     */
    public function acceptedOffer() {
        // Data array returned by the method
        $data = [];
        // Retrieve all the offers from the model
        foreach($this->getAllOffers() as $offer) {
            if ($offer['status'] === self::DONE_STATUS) {
                $data[] = $offer;
            }
        }
        return $data;
    }

    const REFUSED_STATUS = "refused";

    /**
     * Get all offers with the status 'refused'.
     * 
     * @return array An array of offers with the status 'refused'.
     */
    public function refusedOffer() {
        $data = [];
        foreach($this->getAllOffers() as $offer) {
            if ($offer['status'] === self::REFUSED_STATUS) {
                $data[] = $offer;
            }
        }
        return $data;
    }

    const PENDING_STATUS = "pending";

    /**
     * Get all offers with the status 'pending'.
     * 
     * @return array An array of offers with the status 'pending'.
     */
    public function pendingOffer(): array {
        $data = [];
        foreach($this->getAllOffers() as $offer) {
            if ($offer['status'] === self::PENDING_STATUS) {
                $data[] = $offer;
            }
        }
        return $data;
    }

    /**
     * Add a new offer to the model.
     * 
     * @param string $offer The offer to add.
     * @return mixed The result of the insert operation.
     */
    public function addOffer($offer) {
        $record = ['task' => $offer, 'status' => self::PENDING_STATUS];
        $this->connection->insertRecord($record);
        return $this;
    }
}