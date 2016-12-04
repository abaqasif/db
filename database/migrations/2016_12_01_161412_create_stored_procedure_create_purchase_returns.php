<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoredProcedureCreatePurchaseReturns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared("
        

CREATE PROCEDURE `CreatePurchaseReturns` 
(IN `REC_ID` INT UNSIGNED, IN `QTY` INT UNSIGNED, OUT `R_RATE` DOUBLE(11,2) 
    UNSIGNED, OUT `R_TAX_RATE` DOUBLE(3,2) UNSIGNED, OUT `P_TAX_AMOUNT` DOUBLE(10,2)
     UNSIGNED, OUT `R_TOTAL` DOUBLE(30,2) UNSIGNED, OUT `R_DATE` DATE, IN `POD_ID` INT(10) UNSIGNED,
      OUT `PO_ID` INT(10) UNSIGNED, OUT `N_RM_QTY` INT(11) UNSIGNED, OUT `R_QTY` INT(11) UNSIGNED, 
      OUT `R_ID` INT(10) UNSIGNED, OUT `C_REC` INT(11) UNSIGNED, OUT `P_TOTAL` DOUBLE(30,2) UNSIGNED, 
      OUT `RC_QTY` INT(11) UNSIGNED, OUT `RC_TAX_AMOUNT` DOUBLE(11,2) UNSIGNED, OUT `RC_TOTAL` DOUBLE(30,2)
       UNSIGNED, OUT `NEW_QTY` INT(11), OUT `NEW_TAX` DOUBLE(11,2) UNSIGNED, OUT `NEW_TOTAL` DOUBLE(30,2) UNSIGNED)  NO SQL
BEGIN

SELECT SUM(P_QTY) FROM purchase_receipt WHERE 
purchase_orders_details_id=POD_ID INTO C_REC;

IF C_REC IS NULL
THEN SET C_REC=0;
END IF;


IF C_REC>0 THEN

SELECT RM_ID FROM purchase_order_lines WHERE
ID=POD_ID INTO R_ID;
SELECT purchase_orders_id FROM purchase_order_lines
WHERE id=POD_ID INTO PO_ID;



SELECT qty_available  FROM raw_materials where id=R_ID INTO R_QTY;

SET N_RM_QTY=(R_QTY-QTY);

UPDATE raw_materials SET qty_available=N_RM_QTY where id=R_ID;

SELECT rate from raw_materials where id=R_ID INTO R_RATE;

SELECT tax_rate from purchase_order_lines
WHERE id=POD_ID INTO R_TAX_RATE;



SET P_TOTAL=(QTY * R_RATE);
SET P_TAX_AMOUNT= ((R_TAX_RATE * P_TOTAL)/100);

SET R_TOTAL=P_TOTAL+P_TAX_AMOUNT;
SET R_DATE=CURRENT_DATE();




INSERT INTO `purchase_return`(`purchase_receipt_id`, `qty`, `rate`, `tax_rate`, `tax_amount`, `total`, `rdate`) VALUES (REC_ID,QTY, R_RATE,R_TAX_RATE,P_TAX_AMOUNT,R_TOTAL,R_DATE);

SELECT p_qty FROM purchase_receipt WHERE id=REC_ID 
INTO RC_QTY;

SET NEW_QTY=RC_QTY-QTY;

IF NEW_QTY>0 THEN
UPDATE purchase_receipt SET p_qty=NEW_QTY
WHERE id=REC_ID;

SELECT tax_amount FROM purchase_receipt WHERE id=REC_ID 
INTO RC_TAX_AMOUNT;

SET NEW_TAX=RC_TAX_AMOUNT-P_TAX_AMOUNT;

UPDATE purchase_receipt SET tax_amount=NEW_TAX
WHERE id=REC_ID;

SELECT total FROM purchase_receipt WHERE id=REC_ID 
INTO RC_TOTAL;
SET NEW_TOTAL=RC_TOTAL-R_TOTAL;

UPDATE purchase_receipt SET total=NEW_TOTAL
WHERE id=REC_ID;

ELSE
DELETE FROM purchase_receipt WHERE id=REC_ID;
END IF;

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
          \DB::unprepared("DROP procedure IF EXISTS CreatePurchaseReturns");
    }
}
