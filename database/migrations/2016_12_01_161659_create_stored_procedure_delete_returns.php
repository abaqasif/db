<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoredProcedureDeleteReturns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared("
          



CREATE PROCEDURE `DeleteReturns` 
(IN `RET_ID` INT, OUT `RET_QTY` INT(11) UNSIGNED, OUT `R_QTY` 
    INT(11) UNSIGNED, OUT `NEW_QTY` INT(11) UNSIGNED, OUT `R_ID` INT(11) UNSIGNED, 
    OUT `REC_ID` INT(11) UNSIGNED, OUT `R_RATE` DOUBLE(11,2) UNSIGNED, OUT `R_TAX_RATE` DOUBLE(3,2) 
    UNSIGNED, OUT `P_TOTAL` DOUBLE(30,2) UNSIGNED, OUT `NEW_P_TOTAL` DOUBLE(30,2) UNSIGNED, OUT `P_TAX_AMOUNT`
     DOUBLE(11,2) UNSIGNED, OUT `NEW_P_TAX_AMOUNT` DOUBLE(11,2) UNSIGNED, OUT `F_TOTAL` DOUBLE(30,2) UNSIGNED, OUT 
     `F_TAX_AMOUNT` DOUBLE(11,2) UNSIGNED)  NO SQL
BEGIN


SELECT qty FROM purchase_return where id=RET_ID INTO RET_QTY;

SELECT raw_materials.qty_available
from purchase_return join purchase_receipt
on purchase_return.purchase_receipt_id=
purchase_receipt.id
join purchase_order_lines
on purchase_receipt.purchase_orders_details_id=
purchase_order_lines.id
JOIN raw_materials on purchase_order_lines.rm_id
=raw_materials.id
where purchase_return.id=RET_ID INTO R_QTY;

SET NEW_QTY=RET_QTY+R_QTY;


SELECT raw_materials.id
from purchase_return join purchase_receipt
on purchase_return.purchase_receipt_id=
purchase_receipt.id
join purchase_order_lines
on purchase_receipt.purchase_orders_details_id=
purchase_order_lines.id
JOIN raw_materials on purchase_order_lines.rm_id
=raw_materials.id
where purchase_return.id=RET_ID INTO R_ID;

UPDATE raw_materials set qty_available=NEW_QTY
WHERE id=R_ID;

SELECT purchase_return.purchase_receipt_id FROM purchase_return where id=RET_ID INTO REC_ID;


SELECT rate from raw_materials where id=R_ID into R_RATE;

SELECT tax_rate from purchase_receipt where id=REC_ID into R_TAX_RATE;

SELECT tax_amount from purchase_receipt where id=REC_ID
into P_TAX_AMOUNT;

SELECT total from purchase_receipt where id=REC_ID
into P_TOTAL;

SET NEW_P_TOTAL=RET_QTY*R_RATE;
SET NEW_P_TAX_AMOUNT=(RET_QTY*R_RATE)*R_TAX_RATE/100;

set F_TOTAL=NEW_P_TOTAL+NEW_P_TAX_AMOUNT+P_TOTAL;


UPDATE purchase_receipt set total=F_TOTAL
WHERE id=REC_ID;

set F_TAX_AMOUNT=NEW_P_TAX_AMOUNT+P_TAX_AMOUNT;

UPDATE purchase_receipt set tax_amount=F_TAX_AMOUNT
WHERE id=REC_ID;

UPDATE purchase_receipt set p_qty=NEW_QTY
WHERE id=REC_ID;

DELETE FROM purchase_return WHERE id=RET_ID;



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
        \DB::unprepared("DROP procedure IF EXISTS DeleteReturns");
    }
}
