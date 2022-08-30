Projeyi local ortamda çalıştırmak için gerekenler:

- Redis'in çalışabilmesi için local ortamda redis'in kurulu olması gerekmektedir. Örneğin localde yoksa brew install redis komutu ile redisi kurabilirsiniz.
- Php 8 kurulu olması gerekiyor

Projeyi Docker ortamında çalıştırmak için gerekenler

- Laravel Sail paketinin yüklü olması gerekmektedir.



Genel olarak yapılması gerekenler

- Uygulamamızın APP_KEY i yok ise aşağıdaki komut ile oluşturabiliriz. 
  - php artisan key:generate 
- .env.example dosyasını kopyalaıp .env olarak kaydetmemiz gerekiyor, ortam değişikliklerini görebilmek için
  - cp .env.example .env
- Veritabanına hazırladığımız tabloları ekleyebilmek ve fake data ekleyebilmek için aşağıdaki komutu çalıştırabiliriz.
  - php artisan migrate --seed
- Hata loglarını görebilmek için Slack'e mesaj gönderiyoruz. Test ortamında görebilmek için .env dosyasında SLACK_HOST değerini güncellememiz gerekiyor
  - https://webhook.site/ sitesinden Your Unique Url kısmındaki adresi kopyalayıp .env dosyasındaki SLACK_HOST ortam değişkenine aktarmak gerekiyo
    - örnek: https://webhook.site/2f416b62-093d-4d73-80b3-f3d1ca72bec7
- 

Psrs

- Sınıflara Phpdoc eklendi
- 120 karakter limitine uyuldu
- Parametre tipleri eklendi metodlar için
- Veri geri dönüşleri eklendi metodlar için


## Kullanımı

### 0. Gereksinimler

* PHP 8 veya üzeri
* MySQL
* Composer
* Git

### 1 Gerekli kütüphanelerin kurulumu

PHP kütüphanelerinin kurulması için:

```console
$ composer install
```

### 2. Konfigürasyonlar

Ortam değişkenlerini ayarlamak için `.env.example` dosyasını `.env` olarak yeniden isimlendirin ve `DB_` ile başlayan
değişkenleri düzenleyin.

```console
$ cp .env.example .env
```

Aşağıdaki komutla uygulama anahtarını yeniden ürettirin.

```console
$ php artisan key:generate
```

Gerekli veritabanı tablolarının oluşturulması için:

```console
$ php artisan migrate
```

### 3. Uygulamayı çalıştırmak

Uygulamayı çalıştırmak için aşağıdaki komutla basit bir web sunucusu oluşturabilirsiniz:

```console
$ php artisan serve
```

uygulama şu an **localhost:8000** adresinde çalışıyor.

Varsayılan verileri veritabanına eklemek için:

```console
$ php artisan db:seed
```

İleri tarih için zamanlanmış senkronizasyon için arkada sürekli açık olması gereken komut:

```console
$ php artisan schedule:work
```

## Test

Birim testleri çalıştırmak için:

```console
$ ./vendor/bin/phpunit
$ php artisan serve
```

Tarayıcı üzerinde çalışan testleri çalıştırmak için öncelikle bir terminal'de uygulamayı ayağa kaldırın:

```console
$ php artisan serve
```

daha sonra gerekli driver'ları kurmak ve testleri çalıştırmak için (bu testler `.env` dosyasında belirttiğiniz
veritabanını kullanır ve bu testlerin çalışması uzun sürebilir):

```console
$ php artisan dusk:chrome-driver
$ php artisan dusk
```

**NOT:** Bu komutun çalışabilmesi için bilgisayarınızda Google Chrome tarayıcısının yüklü olması gerekir. Olası bir
sorunda
`vendor/laravel/dusk/bin/` dizini altındaki dosyaların 755 izinlerinin olduğundan emin olun:

```console
$ chmod 755 -R ./vendor/laravel/dusk/bin/
```


## RESTfull API Kaynakları

### [POST] `/api/auth/login?version=1`

`email` ve `password` kabul eder. Bilgiler doğrusa, kullanının bilgilerini JSON formatında geri döner.

**Örnek kullanım (varsayılan kullanıcıların `seed` edilmiş olması gerekir):**

İstek: 

```console
curl --location --request POST 'http://127.0.0.1:8000/api/auth/login?version=1' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer 9|al1e1c88IJ3cRCULzA46bjk3rfVWestsH4ocRZMS' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email":"umituz998@gmail.com",
    "password":"123456789"
}'
```

Cevap:

```json
{
    "code": 200,
    "message": "Success",
    "data": {
        "id": 1,
        "name": "Ümit UZ",
        "email": "umituz998@gmail.com",
        "balance": "100.00",
        "access_token": "11|EGyvxIbWslWBDzOGnesF7i623nAOjFjKuBZNeAbV"
    }
}
```
### [POST] `/api/auth/register?version=1`

İstek: 

```console
curl --location --request POST 'http://127.0.0.1:8000/api/auth/register?version=1' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer 11|EGyvxIbWslWBDzOGnesF7i623nAOjFjKuBZNeAbV' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "Ümit Kenan UZ",
    "email": "umituz999@gmail.com",
    "password": 123456789,
    "password_confirmation" : 123456789
}'
```

Cevap:

```json
{
    "code": 200,
    "message": "Success",
    "data": {
        "id": 11,
        "name": "Ümit Kenan UZ",
        "email": "umituz999@gmail.com",
        "balance": 0,
        "access_token": "1|qaimZPPKuz84cT75XFzO171tuECwfVLMJyGLje9k"
    }
}
``````

`access_token` kısmı sonraki istekler için gerekli olacak.


### [POST] `/api/auth/logout?version=1`

İstek: 

```console
curl --location --request POST 'http://127.0.0.1:8000/api/auth/logout?version=1' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer 2|LFyLTbAIbiO3kYo13rQBPXqBD8VdBor29U25hh9L'
```

Cevap:

```json
{
    "code": 200,
    "message": "Success",
    "data": {
        "message": "Logged Out"
    }
}
```

### [GET] `/api/brands?version=1`

Tüm araba markalarını JSON formatında geri döner.

**Örnek kullanım:**

```console
curl --location --request GET 'http://127.0.0.1:8000/api/brands?version%3D1' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer 4|0l9exOV7dZOfy1vf3dR0RyaAtO97DQxYu7HnZQb4'
```

Cevap

```json
{
    "code": 200,
    "message": "Success",
    "data": {
        "total": 15,
        "user_balance": "100.00",
        "data": [
            {
                "id": 20,
                "name": "eaque",
                "model": "recusandae",
                "url": "qui",
                "year": "asperiores",
                "deleted_at": null,
                "created_at": "2022-08-30 13:07:12",
                "updated_at": "2022-08-30 13:07:12"
            }
            //...
        ],
        "version": "api-version-1"
    }
}
```

### [GET] `/api/brands/{id}?version=1`

Belirli bir markayı JSON formatında geri döner.

**Örnek kullanım:**

```console
curl --location --request GET 'http://127.0.0.1:8000/api/brands/2?version=1' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer 4|0l9exOV7dZOfy1vf3dR0RyaAtO97DQxYu7HnZQb4' \
--data-raw ''
```

Cevap

```json
{
    "code": 200,
    "message": "Success",
    "data": {
        "id": 2,
        "name": "labore",
        "model": "ad",
        "url": "eum",
        "year": "saepe",
        "deleted_at": null,
        "created_at": "2022-08-30 13:07:12",
        "updated_at": "2022-08-30 13:07:12"
    }
}
```


