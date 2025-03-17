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
     * Get all tasks with the status 'done'.
     * 
     * @return array An array of tasks with the status 'done'.
     */
    public function acceptedOffer() {
        // Data array returned by the method
        $data = [];
        // Retrieve all the tasks from the model
        foreach($this->getAllOffers() as $offer) {
            if ($offer['status'] === self::DONE_STATUS) {
                $data[] = $offer;
            }
        }
        return $data;
    }

    /**
     * Get all tasks with the status 'todo'.
     * 
     * @return array An array of tasks with the status 'todo'.
     */
    public function refusedOffer() {
        // Data array returned by the method
        $data = [];
        // Retrieve all the tasks from the model
        foreach($this->getAllOffers() as $offer) {
            // Keep only the tasks with the status 'todo' (self::TODO_STATUS)
            if ($offer['status'] === self::TODO_STATUS) {
                $data[] = $offer;
            }
        }
        return $data;
    }

    /**
     * Add a new task to the model.
     * 
     * @param string $task The task to add.
     * @return mixed The result of the insert operation.
     */
    public function addOffer($offer) {
        // Create a new record with the task and the status 'todo' (by default)
        $record = ['task' => $offer, 'status' => self::TODO_STATUS];
        // Call the insertRecord method of the connection property and return the result
        $this->connection->insertRecord($record);
        return $this;
    }
}