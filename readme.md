<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Project

Đây là một project sử dụng Vuejs2 + Laravel. 
Để tiến hành cài đặt, bạn cần có 2 thư mục là nodemodules chứa các packet javascript dùng cho vuejs, và vendor chứa các packet dùng cho laravel.

Sử dụng Vuejs 2, Laravel 5.4. Bản 5.5 mình chưa có thời gian update.

## Yêu cầu cài đặt: 
- Php 7.1 + Composer được cài đặt.
- Node Js + NPM
- MYSQL.

## Cài đặt:
1. Tiến hành download source về chép vào thư mục chứa code, bằng FTP hoặc trình quản lý file.
2. Tiến hành tạo CSDL. Lấy thông tin database name, username, password.
3. Tiến hành copy file .envexample thành .env hoặc vào file config database thay đổi thông tin tương ứng. 
Mình sẽ làm mẫu file .env , sử dụng file này thì có thể phát sinh lỗi bảo mật, nhưng mình chưa có thời gian check lại. Nhưng nếu bạn tự tạo source sử dụng thì chắc không quá quan trọng.

Tạo file .env trong thư mục chứa source:

Nội dung như sau:

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:KPruhM11OmoER5JC6qVruQEVPX/0SJBRES8u4jiw0Qs=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL={đường dẫn thực tế website}

DB_CONNECTION=mysql
DB_HOST={127.0.0.1/localhost - Đường dẫn sever CSDL}
DB_PORT=3306
DB_DATABASE={database name}
DB_USERNAME={username}
DB_PASSWORD={password}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=

API_KEY_123LINK={api_key từ 123link}
API_KEY_SHORTEST={api_key từ SHORTEST}
API_KEY_MEGAURL={api_key từ MEGAURL}
SHORTY_API_KEY={api_key từ Google}
BITLY_ACCESS_TOKEN={access token từ bit.ly}

Các dấu {} là dữ liệu bạn cần phải thay đổi.

Sau khi thay đổi xong các thông số trên thì chạy lệnh:

composer install --> Để cài đặt các vendor cho laravel.

npm run dev --> cài đặt node module cho vuejs lấy thư viện.

php artisan migrate --> Để tiến hành tạo CSDL.

php artisan db:seed --> để tiến hành tạo CSDL mẫu.


## Thông tin sử dụng:

Thông tin đăng nhập: http://{link website}/login
username: demo@gmail.com
password: 123456

Muốn hệ thông chạy bạn phải điền đúng api key. Việc tạo link hiện hơi mất thời gian một xíu vì gọi 2-3 lần vào các sever khác, các tiến trình tạo link phải chờ nhau.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
