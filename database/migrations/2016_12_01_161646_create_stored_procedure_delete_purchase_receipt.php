<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoredProcedureDeletePurchaseReceipt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared("

         

CREATE PROCEDURE `DeletePurchaseReceipt`
 (IN `REC_ID` INT UNSIGNED, OUT `QTY` INT(11) UNSIGNED, 
    OUT `R_QTY` INT(11) UNSIGNED, OUT `R_ID` INT(11) UNSIGNED, OUT `NEW_QTY` INT(11) UNSIGNED)  NO SQL
BEGIN

SELECT purchase_receipt.p_qty FROM purchase_receipt  where id=REC_ID
INTO QTY;

SELECT raw_materials.qty_available FROM purchase_receipt JOIN purchase_order_lines
ON purchase_receipt.purchase_orders_details_id=purchase_order_lines.id 
JOIN raw_materials ON purchase_order_lines.rm_id
=raw_materials.id
WHERE purchase_receipt.id=REC_ID INTO R_QTY;

SELECT raw_materials.id FROM purchase_receipt JOIN purchase_order_lines
ON purchase_receipt.purchase_orders_details_id=purchase_order_lines.id 
JOIN raw_materials ON purchase_order_lines.rm_id
=raw_materials.id
WHERE purchase_receipt.id=REC_ID INTO R_ID;


SET NEW_QTY=(R_QTY-QTY);

UPDATE raw_materials SET qty_available=NEW_QTY
where id=R_ID;


DELETE FROM purchase_return where purchase_return.purchase_receipt_id=REC_ID;

DELETE FROM purchase_receipt WHERE id= REC_ID;

DELETE FROM payments where purchase_receipt_id=REC_ID;




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
         \DB::unprepared("DROP procedure IF EXISTS DeletePurchaseReceipt");
    }
}
