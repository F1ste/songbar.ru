<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SongBar</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('landing/dist/assets/main.css?v=103') }}">
    </head>
    <div class="wrapper">
      <header class="header">
          <div class="header__container">
              <div class="header__content">
                  <a href="/"><img class="header__image" src="{{ asset('landing/dist/images/logo.png') }}" alt="Songbar лого"></a>
                  @auth
                    <a href="{{ url('/home') }}" class="header__button button _sm _main" style="width: auto; max-width: none;">Личный кабинет</a>
                  @else
                    <a href="{{ route('login') }}" class="header__button button _sm _main">Вход</a>
                  @endauth
              </div>
          </div>
      </header>
      <main>
        <section class="promo__container">
          <div class="promo__about-catalog">
            <div class="about-catalog__content">
              <div class="about-catalog__title">
                <div>Online</div>
                <hr>
                <div>Каталог песен</div>
              </div>
              <div class="about-catalog__text">
                Новый уровень сервиса для караоке-бара с нашей интуитивно понятной системой онлайн поиска песен с моментальным
                доступом для гостей заведения
              </div>
              <a href="{{ route('register') }}" class="button _md _outline">Регистрация</a>
            </div>
          </div>
          <img class="promo__image" src="{{ asset('landing/dist/images/promo-iphone.png') }}" alt="изображение iphone">
          <div class="promo__text">
            <div>
              Создайте онлайн-КАТАЛОГ песен для СВОЕГО караоке-бара
            </div>
            <div>
              Всего 3 шага и каталог песен  готов радовать ваших гостей
            </div>
          </div>
        </section>
        <section class="quick-access__container">
            <div class="quick-access__content">
              <div class="quick-access__info">
                <div class="quick-access__title">Быстрый доступ для гостей через уникальный QR код</div>
                <div class="quick-access__text">После создания каталога, вам нужно всего лишь скачать QR код и разместить его на посадочных местах</div>
                <div class="quick-access__checklist">
                  <div>Регистрация</div>
                  <div>Загрузка базы песен</div>
                  <div>Размещение QR кода</div>
                </div>
                <div class="quick-access__image">
                  <img src="{{ asset('landing/dist/images/quick-acess-iphone.png') }}">
                </div>
              </div>
            </div>
        </section>
        <section class="advantages__container">
          <div class="advantages__card">
            <div class="advantages__card-decor">
              <img src="{{ asset('landing/dist/images/decor-before.png') }}" alt="Декоративный элемент">
            </div>
            <div class="advantages__card-info">
              <div class="advantages__card-title">
                Караоке-бар до нас
              </div>
              <ul class="advantages__card-list">
                <li class="advantages__list-item">
                  Ограниченный выбор песен: книжный каталог может ограничивать доступ к современным или более популярным песням, что может разочаровать посетителей.
                </li>
                <li class="advantages__list-item">
                  Сложности с поиском: поиск нужной песни может занять длительное время из-за необходимости пролистывать книгу или запрашивать помощь у персонала.
                </li>
                <li class="advantages__list-item">
                  Возможные повреждения каталога: книги могут изнашиваться или быть повреждены посетителями, что может снизить удобство пользования системой.
                </li>
                <li class="advantages__list-item">
                  Ограниченное количество экземпляров каталога: если несколько групп сразу заинтересованы в поиске песен, это может вызвать конфликты из-за ограниченного количества книг с песнями.
                </li>
              </ul>
            </div>
          </div>
          <div class="advantages__card">
            <div class="advantages__card-decor">
              <img src="{{ asset('landing/dist/images/decor-after.png') }}" alt="Декоративный элемент">
            </div>
            <div class="advantages__card-info">
              <div class="advantages__card-title">
                Караоке-бар с нами
              </div>
              <ul class="advantages__card-list">
                <li class="advantages__list-item">
                  Бесконечный выбор песен: благодаря онлайн каталогу посетители могут найти и выбрать практически любую песню для исполнения, включая новинки и классику.
                </li>
                <li class="advantages__list-item">
                  Удобство и быстрота: посетители могут легко найти нужную песню через поиск в онлайн каталоге, без необходимости листать книги или ждать помощи персонала.
                </li>
                <li class="advantages__list-item">
                  Персонализация и удобство: каждый посетитель может выбрать песню по своему вкусу, сохранить ее в избранное или даже создать плейлист для будущих посещений.
                </li>
                <li class="advantages__list-item">
                  Интерактивный опыт: подключение через QR-код добавляет интерактивности и современности караоке-вечерам, делая их более привлекательными для молодежи и тех, кто ценит инновации.
                </li>
                <li class="advantages__list-item">
                  Экономия времени и ресурсов: отсутствие необходимости в печати и обновлении книжных каталогов позволяет сэкономить время и ресурсы заведения, а также уменьшить затраты на обслуживание.
                </li>
              </ul>
            </div>
          </div>
          <div class="advantages__decor-text">Удобно легко быстро</div>
        </section>
        <section class="stats__container">
          <div class="stats__info">
            <div class="stats__item">
              <div class="stats__value">
                +<span>40%</span>
              </div>
              <div class="stats__text">
                увеличение посещаемости заведения
              </div>
            </div>
            <hr>
            <div class="stats__item">
              <div class="stats__value">
                в <span>2</span> раза
              </div>
              <div class="stats__text">
                дольше гости остаются в заведении
              </div>
            </div>
            <hr>
            <div class="stats__item">
              <div class="stats__value">
                +<span>60%</span>
              </div>
              <div class="stats__text">
                больше повторных посещений
              </div>
            </div>
          </div>
          <div class="stats__image">
            <img src="{{ asset('landing/dist/images/image-stats_1.png') }}" alt="Изображение статистика 1">
            <img src="{{ asset('landing/dist/images/image-stats_2.png') }}" alt="Изображение статистика 2">
          </div>
        </section>
        <section class="tutorial">
          <div class="tutorial__container">
            <div class="tutorial__title">
              Как создать каталог песен для своего караоке-бара?
            </div>
            <div class="tutorial__step">
              <div class="step__title">
                Регистрация и создание каталога
              </div>
              <div class="step__text">
                Управление несколькими каталогами, создание собственной ссылки, выбор подходящего тарифа
              </div>
              <div class="tutorial__demo">
                <img src="{{ asset('landing/dist/images/tutorial-reg.png') }}" alt="демострация регистрации">
                <p>&lt;/&gt;</p>
                <img src="{{ asset('landing/dist/images/tutorial-create-catalog.png') }}" alt="демострация создания каталога">
              </div>
            </div>
            <div class="tutorial__step">
              <div class="step__title">
                Загрузка своей базы песен в xlsx, cvs, txt
              </div>
              <div class="step__text">
                Вы можете загрузить любое кол-во песен и отредактировать в ручную.
              </div>
              <div class="tutorial__demo">
                <img src="{{ asset('landing/dist/images/tutorial-import-catalog.png') }}" alt="демострация импорта каталога">
                <p>&lt;/&gt;</p>
                <img src="{{ asset('landing/dist/images/tutorial-edit-catalog.png') }}" alt="демострация редактирования каталога">
              </div>
            </div>
            <div class="tutorial__step">
              <div class="step__title">
                Создание дизайна и получение QR кода
              </div>
              <div class="step__text">
                Вы можете загрузить любое кол-во песен и отредактировать в ручную.
              </div>
              <div class="tutorial__demo">
                <img src="{{ asset('landing/dist/images/tutorial-edit-design.png') }}" alt="демострация редактирования дизайна">
                <p>&lt;/&gt;</p>
                <img src="{{ asset('landing/dist/images/tutorial-get-qr.png') }}" alt="демострация получения qr-кода">
              </div>
            </div>
          </div>
        </section>
        <section class="tariffs__container">
          <div class="tariffs__title">Тарифы</div>
          <div class="tariffs__items">
            <div class="tariffs__card">
              <div class="tariffs__name">Lite</div>
              <div class="tariffs__text">Что входит</div>
              <ul class="tariffs__checklist">
                <li class="tariffs__checklist-item">Загрузка базы песен</li>
                <li class="tariffs__checklist-item">Собственный логотип</li>
                <li class="tariffs__checklist-item">Создание QR кода</li>
                <li class="tariffs__checklist-item">Кол-во песен до 50000</li>
                <li class="tariffs__checklist-item">Техническая поддержка</li>
                <li class="tariffs__checklist-item">Статистика посещений</li>
              </ul>
              <div class="tariffs__price-wrapper">
                <div class="tariffs__price"><span>5000₽</span>/месяц</div>
                <a href="{{ route('register') }}" class="button _xl _main _fw">Начать</a>
              </div>
            </div>

            <div class="tariffs__card tariffs_accent">
              <div class="tariffs__name">Medium</div>
              <div class="tariffs__text">Что входит</div>
              <ul class="tariffs__checklist">
                <li class="tariffs__checklist-item">Загрузка базы песен</li>
                <li class="tariffs__checklist-item">Собственный логотип</li>
                <li class="tariffs__checklist-item">Создание QR кода</li>
                <li class="tariffs__checklist-item">Кол-во песен неограничено </li>
                <li class="tariffs__checklist-item">Техническая поддержка</li>
                <li class="tariffs__checklist-item">Статистика посещений</li>
                <li class="tariffs__checklist-item">Ваш персональный адрес</li>
              </ul>
              <div class="tariffs__price-wrapper">
                <div class="tariffs__price"><span>10000₽</span>/месяц</div>
                <a href="{{ route('register') }}" class="button _xl _white _fw">Начать</a>
              </div>
            </div>

            <div class="tariffs__card">
              <div class="tariffs__name">VIP</div>
              <div class="tariffs__text">Что входит</div>
              <ul class="tariffs__checklist">
                <li class="tariffs__checklist-item">Загрузка базы песен</li>
                <li class="tariffs__checklist-item">Собственный логотип</li>
                <li class="tariffs__checklist-item">Создание QR кода</li>
                <li class="tariffs__checklist-item">Неограниченное кол-во песен</li>
                <li class="tariffs__checklist-item">Техническая поддержка</li>
                <li class="tariffs__checklist-item">Статистика посещений</li>
                <li class="tariffs__checklist-item">Собственный адрес домена</li>
              </ul>
              <div class="tariffs__price-wrapper">
                <div class="tariffs__price"><span>15000₽</span>/месяц</div>
                <a href="{{ route('register') }}" class="button _xl _main _fw">Начать</a>
              </div>
            </div>
          </div>

        </section>
      </main>

      <footer class="footer__container">
          <div class="footer__content">
              <div class="footer__col">
                  <a class="footer__image" href="/"><img class="footer__image" src="{{ asset('landing/dist/images/logo.png') }}" alt="Songbar лого"></a>
                  <div class="footer__links">
                      <a href="#" class="footer__link">Создать обращение</a>
                      <a href="{{ asset('user_agreement.docx') }}" class="footer__link">Пользовательское соглашение</a>
                      <a href="#" class="footer__link">Политика конфиденциальности</a>
                  </div>
              </div>
              <div class="footer__col">
                  <div class="footer__support">
                      <div class="footer__link-heading">Поддержка</div>
                      <a href="info@songbar.ru" class="footer__link">info@songbar.ru</a>
                      <a href="t.me/helpsongbar" class="footer__link">Telegram: @helpsongbar</a>
                  </div>
              </div>
              <div class="footer__copy">
                  ©2024 SONGBAR - онлайн каталог песен для караоке-бара
              </div>
          </div>
      </footer>
    </div>
  </body>
</html>
