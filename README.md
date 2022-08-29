Projeyi local ortamda çalıştırmak için gerekenler:

- Redis'in çalışabilmesi için local ortamda redis'in kurulu olması gerekmektedir. Örneğin localde yoksa brew install redis komutu ile redisi kurabilirsiniz.
- Php 8 kurulu olması gerekiyor

Projeyi Docker ortamında çalıştırmak için gerekenler

- Laravel Sail paketinin yüklü olması gerekmektedir.



Genel olarak yapılması gerekenler

- Hata loglarını görebilmek için Slack'e mesaj gönderiyoruz. Test ortamında görebilmek için .env dosyasında SLACK_HOST değerini güncellememiz gerekiyor
  - https://webhook.site/ sitesinden Your Unique Url kısmındaki adresi kopyalayıp .env dosyasındaki SLACK_HOST ortam değişkenine aktarmak gerekiyo
    - örnek: https://webhook.site/2f416b62-093d-4d73-80b3-f3d1ca72bec7  

    
