<?php
/**
 * Created by PhpStorm.
 * User: alfmaster
 * Date: 13.05.16
 * Time: 16:47*/

namespace BrainySoft\Config\Models;

use App\Models\MfoList;
use App\Models\GateSettings;
use App\Models\CpServiceLoger;
use Illuminate\Support\Facades\Auth;

class cpFunctions
{

	public static function getVersion(){
		return '37.4.604';
	}

	/**
	 * Here you can make yourself to be a God))
	 * @param $userID
	 *
	 * @return string
	 */
	public static function getUserRole($userID){
		switch ($userID){
			case 1: return 'admin'; break; // alfmaster
			case 15: return 'admin'; break; // Куделин
			case 16: return 'admin'; break; // Влад
			case 17: return 'admin'; break; // Михайленко
			case 24: return 'admin'; break; // Зубарев
			default:
				return 'user';
				break;
		}
	}


    /**
     * Возвращает массив SMS правил в формате key=>русское описание
     */
    public static function getSMSRules()
    {
        $rules = [];
        $rules['signoferta'] = 'Смс о подписание договора (оферты)';
        $rules['prolongationoferta'] = 'Смс о подписание договора пролонгации (оферты)';
        $rules['prolongationcontract'] = 'Прологация контракта';
        $rules['contractclosed'] = 'Закрытие контракта';
        $rules['ng'] = 'Новый год (пока не работает)';
        $rules['dr'] = 'День рождения';
        $rules['payDDS'] = 'Поступил платеж (входящий ДДС) (пока не работает)';
        $rules['leadCheck'] = 'Лид стал в статус На проверке (Check)';
        $rules['leadApproved'] = 'Лид стал в статус Одобрен (Approved)';
        $rules['leadContract'] = 'Лид стал в статус Контракт (Contract)';
        $rules['leadDenied'] = 'Лид стал в статус Отклонен (Denied)';
        $rules['leadTechFault'] = 'Лид стал в статус Отклонен (TechFault)';
        $rules['issue'] = 'Выдача (пока не работает)';
        $rules['beforePay1'] = 'Напоминание о платеже за 1 день';
        $rules['beforePay2'] = 'Напоминание о платеже за 2 дня';
        $rules['beforePay3'] = 'Напоминание о платеже за 3 дня';
        $rules['beforePay4'] = 'Напоминание о платеже за 4 дня';
        $rules['beforePay5'] = 'Напоминание о платеже за 5 дней';
        $rules['beforePay6'] = 'Напоминание о платеже за 6 дней';
        $rules['beforePay7'] = 'Напоминание о платеже за 7 дней';
        $rules['beforePay8'] = 'Напоминание о платеже за 8 дней';
        $rules['beforePay9'] = 'Напоминание о платеже за 9 дней';
        $rules['beforePay10'] = 'Напоминание о платеже за 10 дней';
        $rules['todayPay'] = 'В день платежа';
        $rules['payDelay1'] = 'Просрочка дней: 1';
        $rules['payDelay2'] = 'Просрочка дней: 2';
        $rules['payDelay3'] = 'Просрочка дней: 3';
        $rules['payDelay4'] = 'Просрочка дней: 4';
        $rules['payDelay5'] = 'Просрочка дней: 5';
        $rules['payDelay6'] = 'Просрочка дней: 6';
        $rules['payDelay7'] = 'Просрочка дней: 7';
        $rules['payDelay8'] = 'Просрочка дней: 8';
        $rules['payDelay9'] = 'Просрочка дней: 9';
        $rules['payDelay10'] = 'Просрочка дней: 10';
        $rules['payDelay11'] = 'Просрочка дней: 11';
        $rules['payDelay12'] = 'Просрочка дней: 12';
        $rules['payDelay15'] = 'Просрочка дней: 15';
        $rules['payDelay20'] = 'Просрочка дней: 20';
        $rules['payDelay25'] = 'Просрочка дней: 25';
        $rules['payDelay30'] = 'Просрочка дней: 30';
        $rules['payDelay31'] = 'Просрочка дней: 31';
        $rules['payDelay35'] = 'Просрочка дней: 35';
        $rules['payDelay40'] = 'Просрочка дней: 40';
	    $rules['payDelay41'] = 'Просрочка дней: 41';
        $rules['payDelay49'] = 'Просрочка дней: 49';
	    $rules['payDelay50'] = 'Просрочка дней: 50';
        $rules['payDelay55'] = 'Просрочка дней: 55';
        $rules['payDelay60'] = 'Просрочка дней: 60';
        $rules['payDelay61'] = 'Просрочка дней: 61';
	    $rules['payDelay70'] = 'Просрочка дней: 70';
        $rules['payDelay90'] = 'Просрочка дней: 90';
        $rules['payDelay91'] = 'Просрочка дней: 91';
	    $rules['payDelay100'] = 'Просрочка дней: 100';
        $rules['payDelayEvery5'] = 'Каждый 5 день просрочки до 100';
        $rules['payDelayEvery10'] = 'Каждый 10 день просрочки до 100';
        $rules['payDelayEvery5till60'] = 'Каждый 5 день просрочки до 60';

//        $rules[''] = '';

        
        return $rules;
    }


   public static function makeMenu()
   {
       $menu = [];
        $input = request();


       // Сбербанк
       $menu['sbrf']['on'] = false;
       $menu['sbrf']['active'] = false;
       $menu['sbrf']['files_active'] = false;
       $menu['sbrf']['reports_active'] = false;
       $menu['sbrf']['transactions_active'] = false;

       // Администрирование
       $menu['admin']['on'] = true;
       $menu['admin']['active'] = false;
       $menu['admin']['monitor'] = false;
       $menu['admin']['mfolist'] = false;
       $menu['admin']['filestorage'] = false;
       $menu['admin']['users'] = false;
       $menu['admin']['users'] = false;
       $menu['admin']['fiasload'] = false;
       $menu['admin']['rfmload'] = false;
       $menu['admin']['error-dict'] = false;
       $menu['admin']['equifax_export'] = false;
       $menu['admin']['productdata'] = false;


       // Список МФО
       $menu['mfo']['on'] = false;
       $menu['mfo']['active'] = false;
       $menu['mfo']['arius'] = false;
       $menu['mfo']['yandex'] = false;
       $menu['mfo']['common'] = false;
       $menu['mfo']['sms'] = false;
       $menu['mfo']['emailtemplate'] = false;
       $menu['mfo']['decisiontree'] = false;
       $menu['mfo']['nbki'] = false;
       $menu['mfo']['scorista'] = false;
       $menu['mfo']['equifax'] = false;
       $menu['mfo']['mandarin'] = false;
       $menu['mfo']['teleport'] = false;
       $menu['mfo']['leadStatus'] = false;
       $menu['mfo']['printforms'] = false;
       $menu['mfo']['lk'] = false;
       $menu['mfo']['sbrf'] = false;
	   $menu['mfo']['qiwi'] = false;
	   $menu['mfo']['qiwiterm'] = false;
	   $menu['mfo']['elexnet'] = false;
	   $menu['mfo']['oplataru'] = false;
	   $menu['mfo']['mkb'] = false;
	   $menu['mfo']['ups'] = false;
	   $menu['mfo']['deltapay'] = false;
	   $menu['mfo']['comepay'] = false;
	   $menu['mfo']['futubank'] = false;
	   $menu['mfo']['runabank'] = false;
	   $menu['mfo']['vcxml'] = false;
	   $menu['mfo']['okb'] = false;
       $menu['mfo']['crocus'] = false;
       $menu['mfo']['ui_logs'] = false;

       $menu['mfo']['on'] = true; // временно

        return $menu;
   }


    public static function getFieldsList($service_name)
    {
        $ret = [];
                $ret['common_makeContractIssue'] = '';
                $ret['dadata_token'] = '';
                $ret['consolidate_lead_mercy'] = '';
                $ret['denyloanapp_days'] = 0;
                $ret['denyloanapp_statuses'] = 0;
                $ret['denyloanapp_reason'] = 0;
                $ret['arius_payment_login'] = '';
                $ret['arius_payment_merchant_key'] = '';
                $ret['arius_payment_epid_sale_form'] = '';
                $ret['arius_payment_epid_card_register'] = '';
                $ret['arius_payment_epid_card_to_card'] = '';
                $ret['arius_payment_epid_recurrent'] = '';
                $ret['arius_payment_sale_dds'] = '';
                $ret['arius_payment_loan_dds'] = '';
                $ret['arius_payment_settlement_account_id'] = '';
                $ret['arius_payment_settlement_account_loan_id'] = '';
                $ret['arius_payment_gate'] = '';
                $ret['arius_payment_bs_gate'] = '';
                $ret['arius_payment_comments'] = '';
                $ret['arius_payment_balance_provider'] = '';
                $ret['arius_payment_private_key'] = '';
                $ret['arius_payment_public_key'] = '';
                $ret['sms_service'] = '';
                $ret['sms_login'] = '';
                $ret['sms_password'] = '';
                $ret['sms_sender'] = '';
                $ret['nbki_member_code'] = '';
                $ret['nbki_password'] = '';
                $ret['nbki_type'] = '';
                $ret['nbki_days_decision'] = '';
                $ret['nbki_history_test'] = '';
                $ret['nbki_history_password'] = '';
                $ret['nbki_history_password_test'] = '';
                $ret['nbki_report_user'] = '';
                $ret['nbki_user_id'] = '';
                $ret['nbki_user_id_test'] = '';
                $ret['nbki_credit_purpose'] = '';
                $ret['nbki_member_code_tutdf'] = '';
                $ret['nbki_consent_purpose'] = 1;
                $ret['scorista_ECOMM_sign_method'] = '';
                $ret['scorista_UNO_MOMENTO_sign_method'] = '';
                $ret['scorista_SITE_sign_method'] = '';
                $ret['scorista_LOAN_APPLICATION_sign_method'] = '';
                $ret['scorista_PRESCORE_sign_method'] = '';
                $ret['scorista_GENERATOR_sign_method'] = '';
                $ret['scorista_username'] = '';
                $ret['scorista_password'] = '';
                $ret['scorista_getting_money_methods'] = '';
                $ret['scorista_check_history'] = '';
                $ret['scorista_issue_days'] = '';
		        $ret['equifax_fill_fields_from_client'] = '';
		        $ret['equifax_address'] = '';
		        $ret['equifax_cer'] = '';
		        $ret['equifax_client'] = '';
		        $ret['equifax_cred_type'] = '';
		        $ret['equifax_cred_type_text'] = '';
		        $ret['equifax_id_report'] = '';
		        $ret['equifax_password'] = '';
		        $ret['equifax_cred_account_no'] = '';
		        $ret['equifax_cred_insured'] = '';
		        $ret['equifax_cred_facility'] = '';
		        $ret['equifax_cred_security'] = '';
		        $ret['equifax_application_way'] = '';
		        $ret['equifax_status_list'] = '';
		        $ret['equifax_status_default'] = '';
		        $ret['equifax_app_cred_typecb'] = '';
		        $ret['equifax_app_cred_typecb_default'] = '';
		        $ret['equifax_loan_credit'] = '';
		        $ret['equifax_approval_date'] = '';
	        	$ret['okb_subscriber_code'] = '';
	        	$ret['okb_subscriber_name'] = '';
	        	$ret['okb_group_id'] = '';
	        	$ret['okb_user_id'] = '';
	        	$ret['okb_product_finance_types'] = '';
	        	$ret['okb_collateral_guarantor_type'] = '';
	        	$ret['okb_document_types'] = '';
	        	$ret['okb_collateral_types'] = '';
                $ret['mandarin_opcode_ident'] = '';
                $ret['mandarin_login'] = '';
                $ret['mandarin_pass'] = '';
                $ret['mandarin_opcode_confirm'] = '';
                $ret['mandarin_merchant_id'] = '';
                $ret['mandarin_secret'] = '';
                $ret['teleport_uid'] = '';
                $ret['teleport_secret'] = '';
                $ret['teleport_double_days'] = '';
                $ret['teleport_channel'] = '';
                $ret['teleport_creditproductid'] = '';
                $ret['teleport_paymenttypeid'] = '';
                $ret['teleport_startleadcheck'] = '';
		        $ret['qiwi_settlement_account_id'] = '';
		        $ret['qiwi_merchant_site'] = '';
		        $ret['qiwi_secret_key'] = '';
		        $ret['elexnet_settlement_account_id'] = '';
		        $ret['elexnet_provider_ip'] = '';
		        $ret['elexnet_provider_user'] = '';
		        $ret['elexnet_provider_pass'] = '';
		        $ret['oplataru_settlement_account_id'] = '';
		        $ret['oplataru_provider_ip'] = '';
		        $ret['oplataru_provider_user'] = '';
		        $ret['oplataru_provider_pass'] = '';
		        $ret['mkb_osmp_settlement_account_id'] = '';
		        $ret['ups_osmp_settlement_account_id'] = '';
		        $ret['ups_osmp_provider_ip'] = '';
		        $ret['ups_osmp_provider_user'] = '';
		        $ret['ups_osmp_provider_pass'] = '';
	        	$ret['deltapay_settlement_account_id'] = '';
		        $ret['comepay_osmp_settlement_account_id'] = '';
                $ret['qiwiterm_amount_max'] = 0;
                $ret['qiwiterm_amount_min'] = 0;
                $ret['qiwiterm_settlement_account_id'] = '';
		        $ret['emailtemplate_test'] = '';
            $ret['decisiontree'] = '';
		        $ret['yandexkassa_shopId'] = '';
		        $ret['yandexkassa_scid'] = '';
		        $ret['yandexkassa_secret'] = '';
		        $ret['yandexkassa_settlement_account_id'] = '';
		        $ret['yandexkassa_use_order_sum_in_aviso_dds'] = false;
		        $ret['yandexkassa_dont_check_contract_issue_date'] = false;
		        $ret['yandexkassa_testmode'] = '';
		        $ret['yandexkassa_agentid'] = '';
		        $ret['yandexkassa_deposit_settlement_account_id'] = '';
		        $ret['yandexkassa_sign_sertificate_path'] = '';
		        $ret['yandexkassa_sign_private_key_path'] = '';
		        $ret['yandexkassa_sign_private_key_pass'] = '';
		        $ret['yandexkassa_verify_sertificate_path'] = '';
		        $ret['yandexkassa_verify_test_sertificate_path'] = '';
                $ret['printform_composite_schedule_only_issued'] = '';
                $ret['printform_composite_schedule_date'] = '';
                $ret['printform_barcode_contract'] = '';
                $ret['printform_empty_data_placeholder'] = '';
                $ret['printform_barcode_contract_fields'] = '';
                $ret['printform_barcode_tag'] = '';
                $ret['printform_make_client_photo'] = false;
                $ret['printform_client_photo_tag'] = 2;
                $ret['printform_use_conclusion_date_for_schedule'] = false;
                $ret['printform_append_client_estimation'] = false;
                $ret['printform_append_crocus_contract_schedule'] = false;
	        	$ret['futubank_shop_id'] = '';
	        	$ret['futubank_secret'] = '';
	        	$ret['futubank_settlement_account_id'] = '';
	        	$ret['futubank_success_url'] = '';
	        	$ret['futubank_fail_url'] = '';
                $ret['crocus_point'] = 'https://api.nb-bank.ru:4433';
	        	$ret['crocus_guid'] = '';
	        	$ret['crocus_requestor_id'] = '';
	        	$ret['crocus_credit_products'] = '101357 - 1;101358 - 1;101352 - 1;101351 - 1;101356 - 1;101355 - 1;101361 - 1;101363 - 1;101362 - 1;101348 - 5;101340 - 5;101316 - 5;101338 - 5;101345 - 5;';
	        	$ret['crocus_ofices'] = '101793 - 2;101794 - 16;101792 - 19; 101791 - 9999;';
	        	$ret['crocus_poslist'] = '101931 - 1; 101932 - 2; 101933 - 3; 101934 - 4; 101935 - 7';
                $ret['runabank_endpoint'] = 'https://ecommerce.runabank.ru/pc4x4';
	        	$ret['runabank_mode'] = 'p';
	        	$ret['runabank_cid'] = '';
	        	$ret['runabank_payerid'] = '';
	        	$ret['runabank_product'] = 'card_top_up';
	        	$ret['runabank_money_source'] = 'bank_account';
	        	$ret['runabank_sertificate_path'] = '';
	        	$ret['runabank_privatekey_path'] = '';
	        	$ret['runabank_sertificate_password'] = '';
	        	$ret['runabank_openssl_path'] = '';
	        	$ret['runabank_settlement_account_id'] = '';
	        	$ret['runabank_testmode'] = 1;
	        	$ret['vcxml_credit_product_conformity'] = '';
	        	$ret['vcxml_marital_status'] = '';

        return $ret;
    }

	/**
	 * Русские заголовки для полей из getFieldsList
	 * @param $settings
	 */
    public static function getLabels(){
    	return [
    		'qiwi' => 'QIWI',
    		'qiwi_settlement_account_id' => 'ID счета по которому происходят транзации в Brainysoft',
    		'qiwi_merchant_site' => 'Идентификатор сайта ТСП (Выдается Qiwi)',
    		'qiwi_secret_key' => 'secret_key (Выдается Qiwi)',
		    'elexnet' => 'Элекснет',
		    'elexnet_settlement_account_id' => 'ID счета по которому происходят транзации в Brainysoft',
		    'elexnet_provider_ip' => 'IP адрес с котрого разрешены обращения от Элекснет (не обязательно), если нужно несколько IP - указываются через запятую',
		    'elexnet_provider_user' => 'Логин авторизации, (не обязательно)',
		    'elexnet_provider_pass' => 'Пароль авторизации, (не обязательно)',
		    'oplataru' => 'Оплата.ру',
		    'oplataru_settlement_account_id' => 'ID счета по которому происходят транзации в Brainysoft',
		    'oplataru_provider_ip' => 'IP адрес с котрого разрешены обращения от Элекснет, (не обязательно), если нужно несколько IP - указываются через запятую',
			'oplataru_provider_user' => 'Логин авторизации, (не обязательно)',
		    'oplataru_provider_pass' => 'Пароль авторизации, (не обязательно)',
			'mkb' => 'МКБ',
			'mkb_osmp_settlement_account_id' => 'ID счета по которому происходят транзации в Brainysoft',
			'ups' => 'UPS',
			'ups_osmp_settlement_account_id' => 'ID счета по которому происходят транзации в Brainysoft',
			'ups_osmp_provider_ip' => 'IP адрес с котрого разрешены обращения от Элекснет, (не обязательно), если нужно несколько IP - указываются через запятую',
			'ups_osmp_provider_user' => 'Логин авторизации, (не обязательно)',
			'ups_osmp_provider_pass' => 'Пароль авторизации, (не обязательно)',
			'deltapay' => 'Deltapay',
			'deltapay_settlement_account_id' => 'ID счета по которому происходят транзации в Brainysoft',
			'comepay' => 'Comepay',
			'comepay_osmp_settlement_account_id' => 'ID счета по которому происходят транзации в Brainysoft',
            'qiwiterm' => 'Терминалы КИВИ',
            'qiwiterm_amount_max' => 'Максимальная сумма к приему, (0 - не проверять эту сумму)',
            'qiwiterm_amount_min' => 'Минимальная сумма к приему, (0 - не проверять эту сумму)',
            'qiwiterm_settlement_account_id' => 'ID счета по которому происходят транзации в Brainysoft',
            'yandex' => 'Yandex',
			'yandexkassa_shopId' => 'Идентификатор магазина, выдается при подключении к Яндекс.Кассе.',
			'yandexkassa_scid' => 'Идентификатор витрины магазина, выдается при подключении к Яндекс.Кассе.',
			'yandexkassa_secret' => 'Пароль магазина из личного кабинета в Яндекс Кассе, (поле shopPassword)',
			'yandexkassa_settlement_account_id' => 'ID счета по которому происходят транзации в Brainysoft',
			'yandexkassa_use_order_sum_in_aviso_dds' => 'Использовать сумму платежа в ДДС, (установлен - сколько польователь заплатил, снят - за вычетом комиссии)',
			'yandexkassa_dont_check_contract_issue_date' => 'Не проверять выдан ли контракт при приеме платежей, (ставить осторожно)',
			'yandexkassa_testmode' => 'Флаг тестового режима, если = 1, то используется тестовый сервер Яндекс Кассы, если = 0, то реальный',
			'yandexkassa_agentid' => 'Идентификатор контрагента, выдается Яндекс.Деньгами.',
			'yandexkassa_deposit_settlement_account_id' => 'ID счета по которому происходят транзации в Brainysoft',
			'yandexkassa_sign_sertificate_path' => 'Подписанный Яндексом сертификат организации',
			'yandexkassa_sign_private_key_path' => 'Приватный ключ организации',
			'yandexkassa_sign_private_key_pass' => 'Пароль от приватного ключа организации',
			'yandexkassa_verify_sertificate_path' => 'Сертификат рабочего сервера Яндекс Кассы',
			'yandexkassa_verify_test_sertificate_path' => 'Сертификат тестового сервера Яндекс Кассы',

			'emailtemplate' => 'email',
			'emailtemplate_test' => 'Тестовая настройка',

      'decisiontree' => 'Decision Tree',
      

		    'futubank' => 'Futubank',
			'futubank_shop_id' => 'ИД клиента(shop_id)',
			'futubank_secret' => 'Пароль (secret)',
		    'futubank_settlement_account_id' => 'значение settlement_account_id, которое выбирается из справочника "Банки" данного кастомера',
		    'futubank_success_url' => 'Значение адреса страницы на сайте кастомера, куда будет перенаправлен клиент после успешного проведения платежа',
		    'futubank_fail_url' => 'значение адреса страницы на сайте кастомера, куда будет перенаправлен клиент в случае ошибки при оплате',

			'teleport' => 'Teleport',
			'teleport_uid' => 'uid в системе телепорт',
			'teleport_secret' => 'secret',
			'teleport_double_days' => 'Срок дублирования лидов,(сколько дней должно пройти с момента поступления последнего лида с такими-же данными, чтобы этот лид не считался повтором)',
			'teleport_channel' => 'Какой канал поступления лида, (строго как в программе, например SITE, GENERATOR)',
			'teleport_creditproductid' => 'id кредитного продукта, который будет назначаться лиду при приходе данных от Телепорт',
			'teleport_paymenttypeid' => 'id способа выдачи, который будет назначаться лиду при приходе данных от Телепорт',
			'teleport_startleadcheck' => 'запускать проверку созданного лида в СПР, ( = 1) или нет ( пустое значение или 0 )',

		    'equifax' => 'Equifax',
		    'equifax_fill_fields_from_client' => 'Какие поля консолидировать перед отправкой запроса в Equifax, Поля - через запятую, вложенные сущности через точку. ',
		    'equifax_address' => 'equifax_address',
		    'equifax_cer' => 'Адрес сертификата на сервере, (*.cer)',
		    'equifax_client' => 'Код клиента, (3 символа, буквы и/или цифры)',
		    'equifax_cred_type' => 'Тип договора, (по справочнику №5)',
		    'equifax_cred_type_text' => 'Неучтенный тип договора, (заполняется если тип договора = 99 ) ',
		    'equifax_id_report' => 'equifax_id_report',
		    'equifax_password' => 'equifax_password',
		    'equifax_cred_account_no' => 'Что передавать как cred_account_no, Варианты: "id", "name" (без кавычек)',
		    'equifax_cred_insured' => 'Флаг страховки договора, (По справочнику №36)',
		    'equifax_cred_facility' => 'Статус кредитной линии, (По справочнику №26)',
		    'equifax_cred_security' => 'Тип обеспечения, (По справочнику №7)',
		    'equifax_application_way' => 'Способ оформления кредитной заявки, (по справочнику №60)',
		    'equifax_status_list' => 'Список соответствия "Статуса кредитной заявки", при передаче в Equifax (НАШ_ИД=ИХ_ИД_ИЗ_СПИСКА_61;НАШ_ИД_2=ИХ_ИД_ИЗ_СПИСКА_61_2)',
	        'equifax_status_default' => 'Какой "Статус кредитной заявки", ставить по-умолчанию (по справочнику №61)',
	        'equifax_app_cred_typecb' => 'Список соответствия "Вид займа (кредита)", при передачи в Equifax (НАШ_ИД=ИХ_ИД_ИЗ_СПИСКА_66;НАШ_ИД_2=ИХ_ИД_ИЗ_СПИСКА_66_2) ',
		    'equifax_app_cred_typecb_default' => 'Какой "Вид займа (кредита)", ставить по-умолчанию (по справочнику №66)',
		    'equifax_loan_credit' => 'Вид обязательства для выгрузки ФИЧ, (по справочнику №78)',
		    'equifax_approval_date' => 'Сколько действует кредитное предложение, Если Ядро не вернет approval_date, то от сегодняшей даты будет отсчитано это количество дней. Если не заполнено - будет 14.',

		    'vcxml' => 'Импорт из XML файла сбербанка',
		    'vcxml_credit_product_conformity' => 'Соответствие значения поля decision в XML и № Кредитного продукта в BS, (в формате sbrf_id=bs_id;sbrf_id=bs_id)',
		    'vcxml_marital_status' => 'Соответствие значения поля maritalStatus в XML и в BS, (в формате sbrf_id=bs_id;sbrf_id=bs_id)',

		    'okb' => 'Настройки выгрузки в ОКБ',
			'okb_subscriber_code' => 'Код Подписчика',
			'okb_subscriber_name' => 'Имя Подписчика',
			'okb_group_id' => 'Идентификатор Группы',
			'okb_user_id' => 'Идентификатор Пользователя',
			'okb_product_finance_types' => 'Строка для FinanceType, разделители ; в элементе разделитель "-" , Наш_продукт_i - тип_ОКБ_j; Наш_продукт_i - тип_ОКБ_j;',
			'okb_collateral_guarantor_type' => 'В залогах тип, который соответствует поручителю',
			'okb_document_types' => 'Строка для documentTypes, разделители ; в элементе разделитель "-", Наш_документ_i - тип_ОКБ_j; Наш_документ_i - тип_ОКБ_j;',
			'okb_collateral_types' => 'Строка для collateralTypes, разделители ; в элементе разделитель "-", Наш_залог_id - тип_обеспечения_ОКБ_j; Наш_залог_id - тип_обеспечения_ОКБ_j;',
//            'okb_cbr_finance_types' => 'Строка для кодов СБР (CBRFinanceType) разделители ; в элементе разделитель "-", Категория_займа_для_отчета_ЦБ_id - код_Finance_type_ОКБ_j; Категория_займа_для_отчета_ЦБ_id - код_Finance_type_ОКБ_j;',
            'crocus' => 'Crocus',
            'crocus_point' => 'URL для запросов, (например, https://api.nb-bank.ru:4433)',
            'crocus_guid' => 'Значение GUID в URL',
            'crocus_requestor_id' => 'Значение RequestorID в запросе',
            'crocus_credit_products' => 'Кредитные продукты, разделители ; в элементе разделитель "-", Наш_кредитный продукт_id - кредитный продукт_АБС_j; Наш_кредитный продукт_id - кредитный продукт_АБС_j;',
            'crocus_ofices' => 'Подразделения, разделители ; в элементе разделитель "-", Id_подразделения_в_Брейнисофт - Номер_подразделения_АБС_j; Id_подразделения_в_Брейнисофт - Номер_подразделения_АБС_j;',
            'crocus_poslist' => 'Портфели однородных сумм, разделители ; в элементе разделитель "-", Id_вида_финансового_положения_в_Брейнисофт - Номер_ПОС_АБС_j; Id_вида_финансового_положения_в_Брейнисофт_k - Номер_ПОС_АБС_k;',

        'printform_composite_schedule_only_issued' => 'Параметр only-issued=false в композитном графике, (указать слово false в этом поле), иначе не будет этого параметра',
            'printform_composite_schedule_date' => 'Дата в далеком будущем для композитного графика, если пусто, то на текущую дату',
            'printform_barcode_contract' => 'Тип баркода для контракта',
            'printform_barcode_contract_fields' => 'Поля контракта, которые надо печатать баркодом (через запятую)', //  (переменная с баркодом в ПФ называется barcode)
            'printform_empty_data_placeholder' => 'Заменитель значка \'-\' в отсутствующих полях в документе, (указать пробел, если нужно убрать заменитель, если будет пустая строка, то останется \'-\')',
            'printform_make_client_photo' => 'Поместить фото клиента в печатную форму, имя поля - clientphoto',
            'printform_client_photo_tag' => 'Id тега в файловой системе для фото клиента',
            'printform_barcode_tag' => 'Id тега в файловой системе для баркодов',
            'printform_use_conclusion_date_for_schedule' => 'Получить еще график от даты conclusionDate, если в заявке это поле не пустое',
            'printform_append_client_estimation' => 'Добавить Параметры отчета Суждение клиента, (только для Crocus)',
            'printform_append_crocus_contract_schedule' => 'Добавить график от контракта Крокуса, (только для Crocus)',

            'denyloanapp' => 'Отклонение зависших заявок',
            'denyloanapp_days' => 'Кол-во дней от создания заявки',
            'denyloanapp_statuses' => 'Статусы заявки, в которых она может находиться (через запятую)',
            'denyloanapp_reason' => 'id причины отклонения, (из справочника)',

            'runabank' => 'Настройки Рунабанк',
            'runabank_endpoint' => 'Точка подключения (endpoint)',
            'runabank_mode' => 'Режим работы (mode)',
            'runabank_cid' => 'Идентификатор договора (cid)',
            'runabank_payerid' => 'Пока не знаю, нужен ли этот параметр, или его надо будет вычислять - задал вопрос в Рунабанк',
            'runabank_product' => 'Продукт (product)',
            'runabank_money_source' => 'Источник денежных стредств (source), mc - счет мобильного телефона, bc - банковская карта, bank_account - счет открытый в Банке',
            'runabank_sertificate_path' => 'Путь к сертификату',
            'runabank_privatekey_path' => 'Путь к приватному ключу',
            'runabank_sertificate_password' => 'Пароль к сертификату',
            'runabank_openssl_path' => 'Путь к openssl, (для сервера не заполнять, нужен для Windows)',
            'runabank_settlement_account_id' => 'ID счета по которому происходят транзации в Brainysoft (settlement_account_id)',
            'runabank_testmode' => 'Режим тестирования, (0 - боевой, 1 - Корректные запросы завершаются успехом, 2 - Имитация отсутствия ответа на запрос, 3 - Режим для тестирования обработок ошибок с кодом 1, 4 - Режим для тестирования обработок ошибок с кодом 2xxxx, 5 - имитирует длительную обработку)',

        'productdata' => 'Данные по продукту',
            'ui_logs' => 'Интерфейсные логи',
	    ];


    }

    public static function getSettings($customer_key, $key = '', $default = ''){
    	if( $key == '' ){
		    $settings = GateSettings::where('customer-key', $customer_key)->get();
		    $ret = [];
		    foreach ($settings as $setting){
		    	$ret[$setting->key] = $setting->value;
		    }
	    }else{
		    $setting = GateSettings::where('customer-key', $customer_key)
			    ->where('key', $key)
			    ->first();
		    if( $setting ){
		    	$ret = $setting->value;
		    }else{
		    	$ret = $default;
		    }
	    }

	    return $ret;
    }

    /**
     * Загружаем в массив - настройки для указанного customer_key
     *
     * @param $arr_to_load
     * @param $customer_key
     */
    public static function loadSettings($arr_to_load, $customer_key)
    {
        $settings = GateSettings::where('customer-key', $customer_key)->get();
        foreach( $settings as $one_setting ){
            if( array_key_exists($one_setting->key, $arr_to_load) ){
                $arr_to_load[$one_setting->key] = $one_setting->value;
            }
        }

        return $arr_to_load;
    }

    public static function saveSettings($service, $customer_key)
    {
        $input = request();
        $settings = self::getFieldsList($service);

        foreach( $settings as $key => $val ){
            $settings[$key] = $input->input($key, '');
        }

        $log = new CpServiceLoger();
	    $log->user_id = \Auth::user()->id;
	    $log->service = $service;
	    $log->customer_key = $customer_key;
	    $log->message = print_r($settings, true);
	    $log->save();

        foreach( $settings as $key => $val ){
            $set = GateSettings::where('customer-key', $customer_key)->where('key', $key)->first();
            if( $set ){
                $set->value = $settings[$key];
                $set->save();
            }else{
                $set = new GateSettings();
                $set->{'customer-key'} = $customer_key;
                $set->key = $key;
                $set->value = $val;
                $set->save();
            }
        }

        return true;
    }


    /**
     * Дополнение $data данными, необходимыми для построения левого меню
     *
     * @param $data
     * @return mixed
     */
    public static function menuPrepares($data)
    {

        $user = \Auth::user();
        $data['role'] = self::getUserRole($user->id);
        if( 'admin' == $data['role'] ){
            $data['mfolist'] = MfoList::all();
        }else{
            $data['mfolist'] = MfoList::whereRaw( 'FIND_IN_SET('. $user->id .', manager_id)')->get();
        }

        $data['menu'] = cpFunctions::makeMenu();

        return $data;
    }



}