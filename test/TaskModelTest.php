<?php
namespace App\Tests;
use App\Models\OfferModel;
use PHPUnit\Framework\TestCase;
use App\Models\FileDatabase;

class OfferModelTest extends TestCase {

    public function testGetAcceptedOffers() {
        
        $connection = $this->createStub(FileDatabase::class);
        $connection->method('getAllRecords')->willReturn([
            ['offer' => 'test offer 1', 'status' => 'Accepted'],
            ['offer' => 'test offer 2', 'status' => 'Accepted'],
            ['offer' => 'test offer 3', 'status' => 'Rejected'],
        ]);

        $model = new OfferModel($connection);
        $offers = $model->acceptedOffer();

        $this->assertSame(2, count($offers));
        $this->assertSame('test offer 1', $offers[0]['offer']);
        $this->assertSame('test offer 2', $offers[1]['offer']);
    }

    public function testAddOffer() {
        
        $connection = $this->createMock(FileDatabase::class);
        $connection->method('insertRecord')->willReturn(true);

        // We expect the insertRecord method to be called once with the following data array: ['offer' => 'test offer', 'status' => 'Pending']
        $connection->expects($this->once())
                   ->method('insertRecord')
                   ->with($this->equalTo(['offer' => 'test offer', 'status' => 'Pending']));

        $model = new OfferModel($connection);
        $result = $model->addOffer('test offer');

        $this->assertSame($model, $result);
    }

    public function testGetRejectedOffers() {
        $connection = $this->createStub(FileDatabase::class);
        $connection->method('getAllRecords')->willReturn([
            ['offer' => 'test offer 1', 'status' => 'Accepted'],
            ['offer' => 'test offer 2', 'status' => 'Rejected'],
            ['offer' => 'test offer 3', 'status' => 'Rejected'],
        ]);

        $model = new OfferModel($connection);
        $offers = $model->rejectedOffer();

        $this->assertSame(2, count($offers));
        $this->assertSame('test offer 2', $offers[0]['offer']);
        $this->assertSame('test offer 3', $offers[1]['offer']);
    }

    public function testRemoveOffer() {
        $connection = $this->createMock(FileDatabase::class);
        $connection->method('deleteRecord')->willReturn(true);

        // We expect the deleteRecord method to be called once with the following data array: ['offer' => 'test offer', 'status' => 'Removed']
        $connection->expects($this->once())
                   ->method('deleteRecord')
                   ->with($this->equalTo(['offer' => 'test offer', 'status' => 'Removed']));

        $model = new OfferModel($connection);
        $result = $model->removeOffer('test offer');

        $this->assertSame($model, $result);
    }
}
?>