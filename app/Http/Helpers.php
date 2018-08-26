<?php

namespace App\Http;
use App\Models\Info;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\App;
use Mockery\Exception;
use Auth;
use URL;

class Helpers {

    public static function filter($var) {
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        $var = trim($var);
        return $var;
    }

    public static function LangRU() {
        $data = array();
        $data[] = array(
            'site-title' => 'GPP - это онлайн помощник по подтверждение соблюдения нормативно-правовых актов',
            'description' => 'Онлайн помощник по подтверждение соблюдения нормативно-правовых актов',
            'logo_title' => 'GxP Company',
            'menu1' => 'Главная',
            'menu2' => 'Купить',
            'menu3' => 'Преимущества',
            'menu4' => 'Отзывы',
            'menu5' => 'Контакты',
            'callback' => 'Заказать звонок',
            'h1' => 'Получи сертификат по надлежащей аптечной практике (GPP) с помощью методических указаний портала sam.gpp.kz',
            'h2' => 'Проверьте насколько ваша аптека соответствует требованиям GPP и нормативных актов РК',
            'callback2' => 'Попробовать',
            'callback3' => 'Подробнее',
            'count1_name' => 'человек',
            'count1_name_prev' => '',
            'count2_name' => 'Более',
            'count1_text' => 'Зачем нужна сертификация <br>по стандарту GPP?',
            'count2_text' => 'Как Вам поможет портал SamGPP.kz?',
            'count3_text' => 'Полезная информация',
            'count4_text' => 'Завершенных проектов по сертификации аптек стандарту GPP',
            'count5_text' => 'Завершенных проектов по сертификации складов стандарту GDP',
            'service_text' => 'Как Вам поможет портал SamGPP.kz?',
            'service' => 'Наши услуги',
            's1' => 'Подтверждение соблюдения нормативно-правовых актов',
            's2' => 'Подтверждение соответствия качества лекарственных средств',
            's3' => 'Безопасность, качество лекарственных средств и защита потребителей',
            's4' => 'Показатель надежности аптечной организации',
            's5' => 'Портал SamGPP.kz разработан ведущими специалистами в области внедрения стандартов GxP и представляет собой комплексный инструмент для самостоятельного понимания и внедрения Надлежащей Аптечной Практики',
            's6' => 'В портале представлены обязательные требования GPP и законодательства, предъявляемые к аптеке, с примерами соответствия',
            's7' => 'В портале доступны для скачивания все необходимые СОПы и формы записей с конкретными шаблонами их заполнения.',
            's9' => 'Специальное предложение до 01.09.2018 г. Не упустите!',
            's10' => 'Действующие нормативные акты в сфере обращения ЛС',
            's11' => 'Почему не стоит откладывать внедрение GPP?',
            's12' => 'Дополнительные платные услуги',
            'steps' => 'Как купить?',
            'step1' => 'Вы регистрируетесь на сайте',
            'step2' => 'Наш менеджер свяжется с вами для уточнения ваших реквизитов',
            'step3' => 'Мы вам отправим счет на оплату',
            'step4' => 'Вы производите оплату',
            'step5' => 'Мы активируем ваш аккаунт',
            'step6' => 'Вы получите годовой доступ ко всем ресурсам портала',
            'company' => 'Наши преимущества',
            'c1' => 'Более 100 требований по GPP с примерами соответствия',
            'c2' => 'Доступ с любого устройства, в любом места и в любое время',
            'c3' => 'Обучающие ресурсы для подготовки к инспекции GPP',
            'about' => 'О нас',
            'about_text1' => 'На сегодняшний день у нашей компании имеются успешно завершенные проекты по прохождению GDP сертификации под ключ: «Sanofi-Aventis Kazakhstan», «GSK Kazakhstan», «Servier Kazakhstan», «PROM.MEDIC.KAZ», Teva ratiopharm Kazakhstan, ТОО «Pharmprovide», ТОО «Фарматека», ТОО «Жасулан и Компания», ТОО «Чингиз», TOO «Жанга-Шипа», ТОО «MFS Company», ТОО «Ада Фарм».',
            'about_text2' => 'А также мы оказали услуги в рамках подготовки к GDP сертификации таким компаниям как: Dr.Reddy\'s, ТОО Евросервис Ист, ТОО Демеу Фарма, ТОО Кудермед, ТОО Амир и Д, ТОО Фармконтакт, ТОО Инкар, ТОО «A.N.P», ТОО «Каздинфарма», ТОО «Арифар», ТОО «Сона-Фарм Казахстан», ТОО « Medicus Centre» которые в дальнейшем успешно прошли государственные инспекции по GDP.',
            'about_text3' => '<b>Также, на счету нашей компании около 40 завершенных проектов сертификации аптек стандартам GPP.</b> <br> Среди наших клиентов есть такие компании как ТОО Фармсервис (3 аптеки), ТОО Чингиз (1 аптека), ТОО Нур-торе (1 аптека), ТОО Жасат (3 аптеки), ТОО Жанерке-фарм (2 аптеки), ИП Аймишева (2 аптеки), Фарматека (7аптеки), ТОО Жанга Шипа (1 аптека), Ада Фарм (8аптек), ТОО «Жасулан и Компания» (8 аптек).',
            'cert' => 'Сертификаты',
            'partners' => 'Мы сотрудничаем:',
            'team_text' => 'За период работы компания ТОО «GxP Company» заняла лидирующее место на фармацевтическом рынке Казахстана и зарекомендовала себя как надежный партнер в области внедрения надлежащих фармацевтических практик, проведения валидации/квалификации согласно требованиями законодательства РК. <br><br>Испытательная лаборатория валидации и квалификации ТОО «GxP Company» успешно прошла процедуру аккредитации лаборатории по стандарту ГОСТ ИСО/МЭК 17025-2009 в "Национальный центр аккредитации" — Комитета технического регулирования и метрологии Министерства по инвестициям и развитию Республики Казахстан (НЦА), который является органом по аккредитации в области оценки соответствия и осуществляет свою деятельность, руководствуясь Законом Республики Казахстан "Об аккредитации в области оценки соответствия". <br><br> Компания ТОО «GxP Company» сертифицирована на соответствие СТ РК ИСО 9001-2009 «Системы менеджмента качества. Требования» в Акционерном обществе "Национальный центр экспертизы и сертификации" (АО "НаЦЭкС"), применительно к услугам в области проведения валидации/квалификации на соответствие требованиям стандартов GMP, GDP, GPP, GSP, GAMP.',
            'team' => 'Команда',
            't1' => 'Многолетний опыт работы на фармацевтических предприятиях',
            't2' => 'PhD доктора фармации',
            't3' => 'Выпускники зарубежных университетов',
            't4' => 'Сертифицированный PIC/S инспектор-аудитор',
            'reviews' => 'Отзывы клиентов',
            'quest' => 'Есть вопросы?',
            'quest_text' => 'Закажите БЕСПЛАТНУЮ КОНСУЛЬТАЦИЮ прямо сейчас, оставьте Ваше имя и номер телефона и мы с Вами свяжемся в течении 10 минут',
            'name' => 'Ваше имя',
            'phone' => 'Номер телефона*',
            'contacts' => 'Контакты',
            'contacts_name' => 'TOO «GxP Company»',
            'contacts_address' => 'Адрес: РК, г.&nbsp;Алматы, ул.&nbsp;Аль-Фараби&nbsp;13, Бизнес&nbsp;Центр&nbsp;«Нурлы&nbsp;Тау», блок&nbsp;1В, офис&nbsp;№404',
            'contacts_phones' => 'Телефоны',
            'modal' => 'Обратный звонок',
            'modal_text' => 'Оставьте свой номер телефона и мы Вам перезвоним!',
            'develop' => 'Разработка и поддержка bg.pro',
            'develop_title' => 'Разработка и поддержка landing page в Казахстане',


            'action' => 'Спасибо, Ваша заявка принята, мы с Вами свяжемся в ближайшее время.',
        );
        return $data;
    }

    public static function LangEN() {
        $data = array();
        $data[] = array(
            'site-title' => 'Consulting services for the introduction of appropriate pharmaceuticals',
            'description' => 'Consulting services for the introduction of proper pharmaceutical',
            'logo_title' => 'GxP Company',
            'menu1' => 'Home',
            'menu2' => 'Services',
            'menu3' => 'Benefits',
            'menu4' => 'Reviews',
            'menu5' => 'Contacts',
            'menu5' => 'Contacts',
            'callback' => 'Order call',
            'h1' => 'Consulting services for the implementation of Good Pharmaceutical Practices',
            'h2' => 'Many years experience in pharmaceutical industry',
            'callback2' => 'Contact',
            'callback3' => 'Read more',
            'count1_name' => 'employees',
            'count1_name_prev' => 'Over',
            'count2_name' => 'More than',
            'count1_text' => 'Trained on <br> the implementation of GxP',
            'count2_text' => 'Validated cold rooms, refrigerators and <br> warehouses',
            'count3_text' => 'Validated computerized <br> systems',
            'count4_text' => 'Completed projects for <br> the GPP certification of Pharmacies',
            'count5_text' => 'Completed projects for <br> the GDP certification Warehouses',
            'service_text' => 'We occupy a leading place <br> in the pharmaceutical market of Kazakhstan',
            'service' => 'Our Services',
            's1' => 'Consultation on the implementation of the requirements <b> GPP, GDP, GMP </b>',
            's2' => 'Development of documentation',
            's3' => 'Qualification and validation of premises, refrigerating chambers',
            's4' => 'Diagnostic audit of the company',
            's5' => 'Validation of Computerized Systems',
            's6' => 'Corporate and Open Trainings',
            'steps' => '5 basic steps to prepare the client for GDP / GPP',
            'step1' => 'Determine the degree of compliance with the current GDP / GPP requirements.',
            'step2' => 'Identify inconsistencies and agree on corrective actions',
            'step3' => 'Development of standard operating procedures, instructions and forms',
            'step4' => 'Preparing a package of documents and submitting an application',
            'step5' => 'Training and implementation of the quality management system',
            'step6' => 'Pass the inspection',
            'company' => 'Our company',
            'c1' => 'Is a qualified consultant of the European Bank of Reconstruction and Development (EBRD)',
            'c2' => 'Certified for compliance with ISO 9001 in regards to services of implementation of the Quality Management System (QMS), consulting services in regards to GMP, GDO, GOO,GSP, GAMP and Qualification and Validation services',
            'c3' => 'Has its own laboratory of physical factors accredited in accordance with ISO 17025',
            'about' => 'About Us',
            'about_text1' => 'Up to date, our company has successfully completed projects to guide following companies for GDP certification: Sanofi-Aventis Kazakhstan, GSK Kazakhstan, Servier Kazakhstan, PRO.MEDIK.KAZ, Teva Ratiofarm Kazakhstan, Pharmprovide LLP, Pharmateka LLP, Zhasulan and LLP Company, LLP "Chingiz", LLP "Zhanga-Shipa", LLP "MFS Company", LLP "Ada Farm".' ,
            'about_text2' => 'We provided services for such companies as: Dr. Reddy’s, Euro service East, Demeu Pharma, Kudermed, Amir & D, Pharmcontact, Inkar, A.N.P., Kazdinpharma, Arifar, Sona-Pharm Kazakhstan, Medicus Centre., who later successfully passed GDP certification. ',
            'about_text3' => '<b> Also, on our company\'s account there are about 40 completed GPP certification projects. </b> <br> Among our clients there are such companies as Pharmservice LLP (3 pharmacies), Chingiz LLP (1 pharmacy ), Nur-Tore LLP (1 pharmacy), Jasat LLP (3 pharmacies), Zhanerke-Pharm LLP (2 pharmacies), AI Aimisheva (2 pharmacies), Pharmateka (7apteks), Zhang Shipa (1 pharmacy), Ada Farm 8aptek), LLP "Zhasulan and Company" (8 pharmacies). ',
            'cert' => 'Certificates',
            'partners' => 'We cooperate:',
            'team_text' => 'During the period of operation, GxP Company LLP has taken the leading place in the pharmaceutical market of Kazakhstan and has established itself as a reliable partner in the implementation of proper pharmaceutical practices, validation / qualification according to the requirements of the legislation of the Republic of Kazakhstan. <br> <br> Test laboratory of validation and qualification LLP "GxP Company" successfully passed the accreditation procedure of the laboratory according to the GOST ISO / IEC 17025-2009 standard in the "National Accreditation Center" - the Committee for Technical Regulation and Metrology of the Ministry of Investment and Development of the Republic of Kazakhstan NCA), which is an accreditation body in the field of conformity assessment and carries out its activities, guided by the Law of the Republic of Kazakhstan "On accreditation in the field of conformity assessment". <br> <br> The company "GxP Company" LLP is certified for compliance with ST RK ISO 9001-2009 "Quality management systems. Requirements "in the joint-stock company" National Center for Expertise and Certification "(JSC" NACCEC "), for services in the field of validation / qualification for compliance with the requirements of GMP, GDP, GPP, GSP, GAMP. ',
            'team' => 'Team',
            't1' => 'Many years of experience in pharmaceutical companies',
            't2' => 'PhD Doctor of Pharmacy',
            't3' => 'Graduates of foreign universities',
            't4' => 'Certified PIC / S Inspector-Auditor',
            'reviews' => 'Customer reviews',
            'quest' => 'Do you have any questions?',
            'quest_text' => 'Order a FREE CONSULTATION right now, leave your name and phone number and we will contact you within 10 minutes',
            'name' => 'Your name',
            'phone' => 'Phone number*',
            'contacts' => 'Contacts',
            'contacts_name' => '"TOO" GxP Company',
            'contacts_address' => 'Address: Almaty, Al-Farabi Street 13, Business Center Nurly Tau, Block 1B, Office #404',
            'contacts_phones' => 'Phones',
            'modal' => 'Callback',
            'modal_text' => 'Leave your phone number and we\'ll call you back!',
            'develop' => 'Development and support ONE-PAGE.KZ',
            'develop_title' => 'Development and support of landing page in Kazakhstan',
            'action' => 'Thank you, your application is accepted, we will get back to you as soon as possible.',
        );
        return $data;
    }
}