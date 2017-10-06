<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$countries = "Andorra,U.A.E,Afganisztán,Antigua,Anguilla,Albánia,Örményország,Holland Antillák,Angola,Argentína,Amerikai Szamoa,Ausztria,Ausztrália,Aruba,Aland-szigetek,Azerbajdzsán,Bosznia,Barbados,Banglades,Belgium,Burkina Faso,Bulgária,Bahrein,Burundi,Benin,Bermuda,Brunei,Bolívia,Brazília,Bahamák,Bhután,Bouvet-sziget,Botswana,Fehéroroszország,Belize,Kanada,Kókusz-szigetek,Kongó,Közép-Afrikai Köztársaság,Congo Brazzaville,Svájc,Cote Divoire,Cook-szigetek,Chile,Kamerun,Kína,Colombia,Costa Rica,Kuba,zöld-fok,Karácsonyi sziget,Ciprus,Cseh Köztársaság,Németország,Dzsibuti,Dánia,Dominika,Dominikai Köztársaság,Algéria,Ecuador,Észtország,Egyiptom,Nyugat-Szahara,Eritrea,Spanyolország,Etiópia,Európai Únió,Finnország,Fiji,Falkland-szigetek,Mikronézia,Faroe Szigetek,Franciaország,Gabon,Egyesült Királyság,Skócia,Wales,Grenada,Grúzia,Francia Guyana,Ghána,Gibraltár,Grönland,Gambia,Guinea,Guadeloupe,Egyenlítői-Guinea,Görögország,Szendvics-szigetek,Guatemala,Guam,Bissau-Guinea,Guyana,Hong Kong,Heard Island,Honduras,Horvátország,Haiti,Magyarország,Indonézia,Írország,Izrael,India,Indiai-óceáni terület,Irak,Irán,Izland,Olaszország,Jamaica,Jordánia,Japán,Kenya,Kirgizisztán,Kambodzsa,Kiribati,Comore-szigetek,Saint Kitts és Nevis,Észak Kórea,Dél-Korea,Kuvait,Kajmán-szigetek,Kazahsztán,Laosz,Libanon,Saint Lucia,Liechtenstein,Srí Lanka,Libéria,Lesotho,Litvánia,Luxemburg,Lettország,Líbia,Marokkó,Monaco,Moldova,Montenegró,Madagaszkár,Marshall-szigetek,Macedónia,Mali,Burma,Mongólia,Macau,Északi-Mariana-szigetek,Martinique,Mauritánia,Montserrat,Málta,Mauritius,Maldív-szigetek,Malawi,Mexikó,Malaysia,Mozambik,Namíbia,Új-Kaledónia,Niger,Norfolk-sziget,Nigéria,Nicaragua,Hollandia,Norvégia,Nepál,Nauru,Niue,Új Zéland,Omán,Panama,Peru,Francia Polinézia,Új Gínea,Fülöp-szigetek,Pakisztán,Lengyelország,Saint Pierre,Pitcairn-szigetek,Puerto Rico,Palesztina,Portugália,Palau,Paraguay,Katar,találkozó,Románia,Szerbia,Oroszország,Ruanda,Szaud-Arábia,Salamon-szigetek,Seychelles,Szudán,Svédország,Singapore,Szent Helena,Szlovénia,Jan Mayen,Szlovákia,Sierra Leone,San Marino,Szenegál,Szomáliában,Suriname,Sao Tome,El Salvador,Szíria,Szváziföld,Caicos-szigetek,Csád,Francia Területek,Menni,Thaiföld,Tádzsikisztán,Tokelau,Timorleste,Türkmenisztán,Tunézia,Tonga,Törökország,Trinidad,Tuvalu,Taiwan,Tanzánia,Ukrajna,Uganda,Us Minor Islands,Egyesült Államok,Uruguay,Üzbegisztán,Vatikán város,Saint Vincent,Venezuela,Brit Virgin szigetek,Us Virgin Islands,Vietnam,Vanuatu,Wallis és Futuna,Szamoa,Jemen,Mayotte,Dél-Afrika,Zambia,Zimbabwe";

		$codes = "ad,ae,af,ag,ai,al,am,an,ao,ar,as,at,au,aw,ax,az,ba,bb,bd,be,bf,bg,bh,bi,bj,bm,bn,bo,br,bs,bt,bv,bw,by,bz,ca,cc,cd,cf,cg,ch,ci,ck,cl,cm,cn,co,cr,cu,cv,cx,cy,cz,de,dj,dk,dm,do,dz,ec,ee,eg,eh,er,es,et,eu,fi,fj,fk,fm,fo,fr,ga,gb,gb,gb,gd,ge,gf,gh,gi,gl,gm,gn,gp,gq,gr,gs,gt,gu,gw,gy,hk,hm,hn,hr,ht,hu,id,ie,il,in,io,iq,ir,is,it,jm,jo,jp,ke,kg,kh,ki,km,kn,kp,kr,kw,ky,kz,la,lb,lc,li,lk,lr,ls,lt,lu,lv,ly,ma,mc,md,me,mg,mh,mk,ml,mm,mn,mo,mp,mq,mr,ms,mt,mu,mv,mw,mx,my,mz,na,nc,ne,nf,ng,ni,nl,no,np,nr,nu,nz,om,pa,pe,pf,pg,ph,pk,pl,pm,pn,pr,ps,pt,pw,py,qa,re,ro,rs,ru,rw,sa,sb,sc,sd,se,sg,sh,si,sj,sk,sl,sm,sn,so,sr,st,sv,sy,sz,tc,td,tf,tg,th,tj,tk,tl,tm,tn,to,tr,tt,tv,tw,tz,ua,ug,um,us,uy,uz,va,vc,ve,vg,vi,vn,vu,wf,ws,ye,yt,za,zm,zw";

		$countriesArray = explode(",", $countries);
		$codesArray = explode(",", $codes);


		$x = 0;
		$all = [];

		foreach($countriesArray as $country) {
			$all[] = ["country"=>$country, "code"=>$codesArray[$x]];
	        DB::table('countries')->insert([
	            'name' => $country,            
	            'slug' => str_slug($country, '-'),
	            'code' => $codesArray[$x],
	            'created_at' => date("Y-m-d H:i:s"),
	            'updated_at' => date("Y-m-d H:i:s"),            
	        ]);			
			$x++;
		}
    }
}
