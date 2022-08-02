<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/roboto.css">
    <link rel="stylesheet" href="assets/air-datepicker/air-datepicker.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IQDev</title>
</head>
<body>

    <div class="header">
        <img src="assets/logo-light 1.png" class="header_icon"></img>
        <p class="main_text header_text">Deposit Calculator</p>
    </div>

    <div class="container">
        <p class="main_text content_header_text"> 
            Депозитный калькулятор 
        </p>
        <p class="main_text content_header_desc">
            Калькулятор депозитов позволяет рассчитать ваши доходы после внесения суммы на счет в банке по опредленному тарифу.
        </p>


        <form action="" name="sendedData" id="sendedData">
            <div class="content_input_menu">
                    <input required type="text" name="startDate" class="content_main_inputStyle" placeholder="Дата открытия" id="date_el">
                    <div class="content_main_inputStyle content_main_customInput">
                        <input digits="true" required min="1" max="60" id="depTerm" class="content_main_inputDepositTerm" required type="number" name="term" placeholder="Срок вклада">
                        <select id="typeDimension"  class="content_main_selectCustom">
                            <option selected="selected" value="m">Месяц</option>
                            <option value="y">Год</option>
                        </select>
                    </div>
                    <input id="summOfEnt" digits="true" required type="number" min="1000" max="3000000" name="sum" class="content_main_inputStyle" placeholder="Сумма вклада">
                    <input type="number" digits="true" min="3" max="100" required class="content_main_inputStyle" name="percent" id="interestRatet" placeholder="Процентная ставка, % годовых">

                    <div class="content_inputRadioBlock">
                    <input  class="content_inputRadio" id="inputRadio_depositAct" type="checkbox"> 
                    <label class="main_text content_inputRadio_Label" for="inputRadio_depositAct">Ежемесячное пополнение вклада</label>
                    </div>

                    <input name="sumAdd" digits="true" min="0" max="3000000" type="number" class="content_main_inputStyle content_replenishmentAmout" id="replenishmentAmount" placeholder="Сумма пополнения вклада">
            </div>
            <div id="hide_block" class="content_hideBlock_result">
                <p class="main_text content_hideBlock_result__label">Сумма к выплате</p>
                <p id="result_Price_label" class="main_text content_hideBlock_result__priceText">₽ 0</p>
            </div>
            <input type="button" name="submit" id="resultButton" class="main_text content_calculateButton" value="Рассчитать">
            
        </form>
    </div>
    



<script src="assets/jquery.min.js"></script>
<script src="assets/jquery.validate.min.js"></script>
<script src="assets/air-datepicker/air-datepicker.js"></script>
<script src="script.js"></script>



</body>




</html>

