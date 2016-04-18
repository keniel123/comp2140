$(function(){
    $('#bank_account_button').click(showBankAccount);
    $('#credit_card_button').click(showCreditCard);
    $('#paypal_button').click(showPayPal);
});

function showBankAccount(){
    $('#credit-card').hide(1000);
    $('#paypal').hide(1000);
    $('#bankaccount').show(1000);
};

function showCreditCard(){
    $('#paypal').hide(1000);
    $('#bankaccount').hide(1000);
    $('#credit-card').show(1000);
};

function showPayPal(){
    $('#credit-card').hide(1000);
    $('#bankaccount').hide(1000);
    $('#paypal').show(1000);
};