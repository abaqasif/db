<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoredProcedureDeletePurchaseOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared("



CREATE PROCEDURE `DeletePurchaseOrderDetails` (IN `POD_ID` INT UNSIGNED, OUT `PO_ID` INT(10) UNSIGNED, OUT `PO_AMT` DOUBLE(30,2) ZEROFILL, OUT `POD_AMT` DOUBLE(30,2) ZEROFILL, OUT `NEW_AMT` DOUBLE(30,2) ZEROFILL)  NO SQL
BEGIN
SELECT purchase_orders_id FROM purchase_order_lines WHERE id=POD_ID INTO PO_ID ;
SELECT total FROM purchase_order_lines WHERE id=POD_ID into POD_AMT ;
SELECT total FROM purchase_orders WHERE id=PO_ID into PO_AMT ;

SET NEW_AMT=PO_AMT-POD_AMT;

IF NEW_AMT!=0 THEN
UPDATE purchase_orders SET total=NEW_AMT 
WHERE id=PO_ID;
DELETE FROM purchase_order_lines WHERE id=POD_ID;

ELSE 
DELETE FROM purchase_order_lines WHERE id=POD_ID;
DELETE FROM purchase_orders WHERE id=PO_ID;
END IF;



END





            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::unprepared("DROP procedure IF EXISTS DeletePurchaseOrderDetails");
    }
}
