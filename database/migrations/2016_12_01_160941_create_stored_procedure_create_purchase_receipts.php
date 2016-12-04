<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoredProcedureCreatePurchaseReceipts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared("

CREATE PROCEDURE `CreatePurchaseReceipts` (IN `POD_ID` INT UNSIGNED, OUT `PO_ID` INT(10), 
OUT `R_ID` INT(10), OUT `R_QTY` INT(11), IN `QTY` INT(11), OUT `N_RM_QTY` INT(11),
 OUT `R_RATE` DOUBLE(11,2) UNSIGNED, OUT `R_TAX_RATE` DOUBLE(3,2) UNSIGNED, OUT `P_TOTAL`
 DOUBLE(30,2) UNSIGNED, OUT `P_TAX_AMOUNT` DOUBLE(10,2), OUT `R_TOTAL` DOUBLE(30,2) UNSIGNED, 
OUT `R_DATE` DATE, OUT `C_REC` INT(11) UNSIGNED, OUT `C_ORD` INT(11) UNSIGNED)  NO SQL
BEGIN

SELECT SUM(P_QTY) FROM purchase_receipt WHERE 
purchase_orders_details_id=POD_ID INTO C_REC;

IF C_REC IS NULL
THEN SET C_REC=0;
END IF;

SELECT SUM(QTY) FROM purchase_order_lines WHERE 
id=POD_ID INTO C_ORD;

IF C_REC<C_ORD THEN

SELECT RM_ID FROM purchase_order_lines WHERE
ID=POD_ID INTO R_ID;
SELECT purchase_orders_id FROM purchase_order_lines
WHERE id=POD_ID INTO PO_ID;



SELECT qty_available  FROM raw_materials where id=R_ID INTO R_QTY;

SET N_RM_QTY=(R_QTY+QTY);

UPDATE raw_materials SET qty_available=N_RM_QTY where id=R_ID;

SELECT rate from raw_materials where id=R_ID INTO R_RATE;

SELECT tax_rate from purchase_order_lines
WHERE id=POD_ID INTO R_TAX_RATE;



SET P_TOTAL=(QTY * R_RATE);
SET P_TAX_AMOUNT= ((R_TAX_RATE * P_TOTAL)/100);

SET R_TOTAL=P_TOTAL+P_TAX_AMOUNT;
SET R_DATE=CURRENT_DATE();



INSERT INTO `purchase_receipt`(`purchase_orders_id`, `purchase_orders_details_id`, `p_qty`, `rate`, `tax_rate`, `tax_amount`, `total`, `pdate`) VALUES (PO_ID,POD_ID, QTY, R_RATE ,R_TAX_RATE,P_TAX_AMOUNT,R_TOTAL,R_DATE);
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
        \DB::unprepared("DROP procedure IF EXISTS CreatePurchaseReceipts");
    }
}
