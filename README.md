<h1>evoLib4TR</h1>

<b>İçerisinde Json olarak barındırılır.</b>
<li>Vergi daireleri</li>
<li>Üniversiteler</li>
<li>Şehir / ilçe / semt / mahalle</li>
<li>Sürücü belgesi çeşitleri</li>
<br>
<b>Array olarak veya direk json dosyasına erişerek kullanabilirsiniz</b>
<li>Vergi daireleri için getCityTaxAdminsArray(Şehirin plaka kodu gereklidir.)</li>
<li>Üniversiteler için getUniversityArray()</li>
<li>Şehirler için getCityArray()</li>
<li>İlçe için getCitDistrictArray(Şehirin plaka kodu gereklidir.)</li>
<li>Semt / mahalle için getCityDistrictSMArray(İlçe id gerekir)</li>
<li>Sürücü belgesi için getDriverLicenceArray()</li>
<br>
<b>Sorgulamalar için</b>
<li>Vergi dairesi adı için getCityTaxAdminName(Şehirin plaka kodu,vergi dairesi kodu)</li>
<li>Üniversiteler için getUniversity(Üniversite Idsi gerekir)</li>
<li>Şehirler için getCity(Şehirin plaka kodu)</li>
<li>İlçe için getCitDistrictArray(Şehirin plaka kodu gereklidir.)</li>
<li>Semt / mahalle için getCityDistrict(Şehirin plaka kodu gereklidir,İlçe kodu)</li>
<li>Sürücü belgesi için getDriverLicence(Lisans Idsi gerekir)</li>
<br>
<b>Kontrol</b>
<li>checkTaxOrTC();Return(Array); Fonksiyonuna Verginumarası yada TC kimlik vererek numarasının doğruluk kontrolünü yapabilirsiniz.</li>
<li>checkNationalityId();Return(Boolean); Fonksiyonuna TC kimlik numarası vererek numarasının doğruluk kontrolünü yapabilirsiniz.</li>
<li>checkTaxNumber();Return(Boolean); Fonksiyonuna Verginumarası vererek numarasının doğruluk kontrolünü yapabilirsiniz.</li>