<?php

namespace Database\Seeders;

use App\Models\Market;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Vendor::factory(10000)->create();
        // \App\Models\Restaurant::factory(10000)->create();
        // $this->call([
        //     UserSeeder::class
        // ]);

            //save zones 
            [
                {
                    "areaId": 20,
                    "coordinates": [
                        {
                            "latitude": 31.444994477630136,
                            "longitude": 34.74360572172193
                        },
                        {
                            "latitude": 31.448399411387175,
                            "longitude": 34.75244628263501
                        },
                        {
                            "latitude": 31.4531221791518,
                            "longitude": 34.7572528011897
                        },
                        {
                            "latitude": 31.456709859077712,
                            "longitude": 34.77107154203443
                        },
                        {
                            "latitude": 31.43717730679133,
                            "longitude": 34.77394687009839
                        },
                        {
                            "latitude": 31.425120743022458,
                            "longitude": 34.7861777432063
                        },
                        {
                            "latitude": 31.390047655794667,
                            "longitude": 34.75109444929151
                        },
                        {
                            "latitude": 31.391246849364787,
                            "longitude": 34.74972652269391
                        },
                        {
                            "latitude": 31.391647388053375,
                            "longitude": 34.749089498052875
                        },
                        {
                            "latitude": 31.391718222691885,
                            "longitude": 34.74813060833005
                        },
                        {
                            "latitude": 31.391493555068504,
                            "longitude": 34.74750028921155
                        },
                        {
                            "latitude": 31.39105337668884,
                            "longitude": 34.74670099092511
                        },
                        {
                            "latitude": 31.390576562149572,
                            "longitude": 34.74583731962232
                        },
                        {
                            "latitude": 31.389787780801523,
                            "longitude": 34.74650250745801
                        },
                        {
                            "latitude": 31.388907405986263,
                            "longitude": 34.74695311857251
                        },
                        {
                            "latitude": 31.38855823033407,
                            "longitude": 34.747146237621585
                        },
                        {
                            "latitude": 31.387815798443743,
                            "longitude": 34.74729644132642
                        },
                        {
                            "latitude": 31.387517850919046,
                            "longitude": 34.747146237621585
                        },
                        {
                            "latitude": 31.38725653785464,
                            "longitude": 34.74746810270337
                        },
                        {
                            "latitude": 31.387187560243184,
                            "longitude": 34.747816119323055
                        },
                        {
                            "latitude": 31.387228488873532,
                            "longitude": 34.748207051286975
                        },
                        {
                            "latitude": 31.38774996958104,
                            "longitude": 34.748774338493625
                        },
                        {
                            "latitude": 31.388573113257173,
                            "longitude": 34.749436844120304
                        },
                        {
                            "latitude": 31.389194759401576,
                            "longitude": 34.75048558784513
                        },
                        {
                            "latitude": 31.390036207572233,
                            "longitude": 34.75110517812757
                        },
                        {
                            "latitude": 31.42504728674534,
                            "longitude": 34.78597219453146
                        },
                        {
                            "latitude": 31.402303322053633,
                            "longitude": 34.79119883848218
                        },
                        {
                            "latitude": 31.371666882198753,
                            "longitude": 34.833556283245365
                        },
                        {
                            "latitude": 31.361186835017424,
                            "longitude": 34.82548819852857
                        },
                        {
                            "latitude": 31.354810290564178,
                            "longitude": 34.81793509794263
                        },
                        {
                            "latitude": 31.361186835017374,
                            "longitude": 34.77982627225904
                        },
                        {
                            "latitude": 31.350485721240535,
                            "longitude": 34.760171044597904
                        },
                        {
                            "latitude": 31.33736420087444,
                            "longitude": 34.74502192808179
                        },
                        {
                            "latitude": 31.334285143300715,
                            "longitude": 34.723435509929935
                        },
                        {
                            "latitude": 31.33323585810612,
                            "longitude": 34.71733616663007
                        },
                        {
                            "latitude": 31.331086848856284,
                            "longitude": 34.71338259054212
                        },
                        {
                            "latitude": 31.330330789157667,
                            "longitude": 34.706725347767154
                        },
                        {
                            "latitude": 31.329501407594034,
                            "longitude": 34.699982274303714
                        },
                        {
                            "latitude": 31.347150536200314,
                            "longitude": 34.68828784299878
                        },
                        {
                            "latitude": 31.35664267520432,
                            "longitude": 34.70687018705396
                        },
                        {
                            "latitude": 31.387128313872527,
                            "longitude": 34.709293833104255
                        }
                    ],
                    "latitude": 31.39022,
                    "longitude": 34.7565186,
                    "distance": 5059928.75531495,
                    "name": "Rahat",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 9,
                    "coordinates": [
                        {
                            "latitude": 31.73516302948328,
                            "longitude": 35.1737615113037
                        },
                        {
                            "latitude": 31.7292682526373,
                            "longitude": 35.17888989494018
                        },
                        {
                            "latitude": 31.72527127109874,
                            "longitude": 35.18762316749267
                        },
                        {
                            "latitude": 31.73202406186899,
                            "longitude": 35.20285811469726
                        },
                        {
                            "latitude": 31.7265488638514,
                            "longitude": 35.20757880256347
                        },
                        {
                            "latitude": 31.72167566553857,
                            "longitude": 35.23375716254882
                        },
                        {
                            "latitude": 31.72198595172048,
                            "longitude": 35.23916449592284
                        },
                        {
                            "latitude": 31.732425563658083,
                            "longitude": 35.24691071555785
                        },
                        {
                            "latitude": 31.739104838169773,
                            "longitude": 35.2522858624237
                        },
                        {
                            "latitude": 31.746221567891656,
                            "longitude": 35.25105204627685
                        },
                        {
                            "latitude": 31.749943947129147,
                            "longitude": 35.248863363720695
                        },
                        {
                            "latitude": 31.751120844722053,
                            "longitude": 35.24798359916381
                        },
                        {
                            "latitude": 31.752881601558663,
                            "longitude": 35.24753298804931
                        },
                        {
                            "latitude": 31.755739338973974,
                            "longitude": 35.2504136805313
                        },
                        {
                            "latitude": 31.77479702778379,
                            "longitude": 35.25222148940734
                        },
                        {
                            "latitude": 31.78401147285288,
                            "longitude": 35.237572604872504
                        },
                        {
                            "latitude": 31.78193930027341,
                            "longitude": 35.2393530887442
                        },
                        {
                            "latitude": 31.778690549217565,
                            "longitude": 35.238558651961604
                        },
                        {
                            "latitude": 31.775177180987654,
                            "longitude": 35.23782858819536
                        },
                        {
                            "latitude": 31.773186899535375,
                            "longitude": 35.232013056136886
                        },
                        {
                            "latitude": 31.77275436340609,
                            "longitude": 35.22987164751462
                        },
                        {
                            "latitude": 31.77279612068897,
                            "longitude": 35.227537119843284
                        },
                        {
                            "latitude": 31.776027763668782,
                            "longitude": 35.22624563620261
                        },
                        {
                            "latitude": 31.777953641499185,
                            "longitude": 35.2256213520544
                        },
                        {
                            "latitude": 31.77920457129534,
                            "longitude": 35.22553350970916
                        },
                        {
                            "latitude": 31.779152698944667,
                            "longitude": 35.225599223830024
                        },
                        {
                            "latitude": 31.78041415786026,
                            "longitude": 35.227724874474326
                        },
                        {
                            "latitude": 31.781926403823032,
                            "longitude": 35.229206794955054
                        },
                        {
                            "latitude": 31.783266200024393,
                            "longitude": 35.23331660971812
                        },
                        {
                            "latitude": 31.784022302776933,
                            "longitude": 35.23751225516967
                        },
                        {
                            "latitude": 31.774792467360957,
                            "longitude": 35.252124929882804
                        },
                        {
                            "latitude": 31.784788374194353,
                            "longitude": 35.26154484794311
                        },
                        {
                            "latitude": 31.7880714655218,
                            "longitude": 35.259592199780265
                        },
                        {
                            "latitude": 31.80236979237137,
                            "longitude": 35.256073141552726
                        },
                        {
                            "latitude": 31.806855801224483,
                            "longitude": 35.24392809913329
                        },
                        {
                            "latitude": 31.80860637973855,
                            "longitude": 35.24096694038085
                        },
                        {
                            "latitude": 31.81632858793608,
                            "longitude": 35.240108633496085
                        },
                        {
                            "latitude": 31.817624866414395,
                            "longitude": 35.23945953891448
                        },
                        {
                            "latitude": 31.817681275482315,
                            "longitude": 35.24147119567565
                        },
                        {
                            "latitude": 31.816700094661233,
                            "longitude": 35.24566617057494
                        },
                        {
                            "latitude": 31.81506249090815,
                            "longitude": 35.2472433094757
                        },
                        {
                            "latitude": 31.812804897694967,
                            "longitude": 35.24903502509765
                        },
                        {
                            "latitude": 31.811827084012933,
                            "longitude": 35.2517816071289
                        },
                        {
                            "latitude": 31.811651577897315,
                            "longitude": 35.25478568122558
                        },
                        {
                            "latitude": 31.822208703041596,
                            "longitude": 35.263111258007804
                        },
                        {
                            "latitude": 31.82749592865057,
                            "longitude": 35.25422778175048
                        },
                        {
                            "latitude": 31.82848041308011,
                            "longitude": 35.2527901177185
                        },
                        {
                            "latitude": 31.830230581695815,
                            "longitude": 35.25129344508819
                        },
                        {
                            "latitude": 31.83139734233654,
                            "longitude": 35.24953928039245
                        },
                        {
                            "latitude": 31.83526213160794,
                            "longitude": 35.24980750129394
                        },
                        {
                            "latitude": 31.838520643023557,
                            "longitude": 35.251824522473136
                        },
                        {
                            "latitude": 31.842872741017676,
                            "longitude": 35.25263991401366
                        },
                        {
                            "latitude": 31.84661857090879,
                            "longitude": 35.24294104621581
                        },
                        {
                            "latitude": 31.84846864488324,
                            "longitude": 35.227641725994864
                        },
                        {
                            "latitude": 31.854351268963896,
                            "longitude": 35.22454109237365
                        },
                        {
                            "latitude": 31.85824015637512,
                            "longitude": 35.225394034840384
                        },
                        {
                            "latitude": 31.86234757286746,
                            "longitude": 35.22770609901122
                        },
                        {
                            "latitude": 31.85972322137503,
                            "longitude": 35.210904741741935
                        },
                        {
                            "latitude": 31.85848391831284,
                            "longitude": 35.20955290839843
                        },
                        {
                            "latitude": 31.85739837538181,
                            "longitude": 35.208231920458594
                        },
                        {
                            "latitude": 31.854198626218203,
                            "longitude": 35.20982917592696
                        },
                        {
                            "latitude": 31.852100332419884,
                            "longitude": 35.21001961276702
                        },
                        {
                            "latitude": 31.84506010541662,
                            "longitude": 35.21048631713561
                        },
                        {
                            "latitude": 31.829738350126767,
                            "longitude": 35.20257916495971
                        },
                        {
                            "latitude": 31.820923314510996,
                            "longitude": 35.2096923832672
                        },
                        {
                            "latitude": 31.8115239368765,
                            "longitude": 35.20925250098876
                        },
                        {
                            "latitude": 31.80621756122285,
                            "longitude": 35.20150628135375
                        },
                        {
                            "latitude": 31.79467377396718,
                            "longitude": 35.19354548499755
                        },
                        {
                            "latitude": 31.779398379820588,
                            "longitude": 35.17298903510741
                        },
                        {
                            "latitude": 31.77489963723735,
                            "longitude": 35.15402045295409
                        },
                        {
                            "latitude": 31.767627765521485,
                            "longitude": 35.14329161689452
                        },
                        {
                            "latitude": 31.75835524312943,
                            "longitude": 35.14157500312499
                        },
                        {
                            "latitude": 31.755554603627793,
                            "longitude": 35.15311923072509
                        },
                        {
                            "latitude": 31.74596610500595,
                            "longitude": 35.166980886914054
                        },
                        {
                            "latitude": 31.742462542896643,
                            "longitude": 35.16989913032226
                        }
                    ],
                    "latitude": 31.7799,
                    "longitude": 35.2184793,
                    "distance": 5120977.288130087,
                    "name": "Jerusalem",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 8,
                    "coordinates": [
                        {
                            "latitude": 32.13053984672969,
                            "longitude": 34.93726243850323
                        },
                        {
                            "latitude": 32.08339162149381,
                            "longitude": 34.933957956996885
                        },
                        {
                            "latitude": 32.08106447904298,
                            "longitude": 34.955415629116025
                        },
                        {
                            "latitude": 32.07815546765904,
                            "longitude": 34.99009122726056
                        },
                        {
                            "latitude": 32.088482039028094,
                            "longitude": 34.9870013224754
                        },
                        {
                            "latitude": 32.088263884092314,
                            "longitude": 34.98279561874005
                        },
                        {
                            "latitude": 32.09818940638004,
                            "longitude": 34.985670946804014
                        },
                        {
                            "latitude": 32.100861478134426,
                            "longitude": 34.98577823516461
                        },
                        {
                            "latitude": 32.102651904244254,
                            "longitude": 34.990616940227476
                        },
                        {
                            "latitude": 32.102429238948865,
                            "longitude": 34.9909280764732
                        },
                        {
                            "latitude": 32.102466728551896,
                            "longitude": 34.991414897409406
                        },
                        {
                            "latitude": 32.102563292610114,
                            "longitude": 34.99159594651791
                        },
                        {
                            "latitude": 32.10268172544799,
                            "longitude": 34.99185712662074
                        },
                        {
                            "latitude": 32.10291134839037,
                            "longitude": 34.992626082417694
                        },
                        {
                            "latitude": 32.10429851713314,
                            "longitude": 34.993439713758555
                        },
                        {
                            "latitude": 32.10626442370074,
                            "longitude": 34.99517690510037
                        },
                        {
                            "latitude": 32.106739874424015,
                            "longitude": 34.99687118109795
                        },
                        {
                            "latitude": 32.108707680882496,
                            "longitude": 34.99825888898703
                        },
                        {
                            "latitude": 32.10972156460696,
                            "longitude": 35.002219631602195
                        },
                        {
                            "latitude": 32.11633320476049,
                            "longitude": 35.00334796149763
                        },
                        {
                            "latitude": 32.120963520603446,
                            "longitude": 35.00645039722803
                        },
                        {
                            "latitude": 32.12497574569134,
                            "longitude": 35.01071154725286
                        },
                        {
                            "latitude": 32.126958917499536,
                            "longitude": 35.01123373982045
                        },
                        {
                            "latitude": 32.136169474933226,
                            "longitude": 35.00687431198093
                        },
                        {
                            "latitude": 32.1391290178208,
                            "longitude": 34.99358849253985
                        },
                        {
                            "latitude": 32.14203182883604,
                            "longitude": 34.98993364748093
                        },
                        {
                            "latitude": 32.1480888248646,
                            "longitude": 34.994071457800594
                        },
                        {
                            "latitude": 32.15421808439721,
                            "longitude": 34.989025384453264
                        },
                        {
                            "latitude": 32.155811113444926,
                            "longitude": 34.98555821020636
                        },
                        {
                            "latitude": 32.153770875994915,
                            "longitude": 34.981919374582496
                        },
                        {
                            "latitude": 32.15187032225312,
                            "longitude": 34.97498502608868
                        },
                        {
                            "latitude": 32.15775621886808,
                            "longitude": 34.961938761440244
                        },
                        {
                            "latitude": 32.157538229475435,
                            "longitude": 34.948205851283994
                        }
                    ],
                    "latitude": 32.1202395,
                    "longitude": 34.9707303,
                    "distance": 5125074.815231073,
                    "name": "Kfar Qasem",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 27,
                    "coordinates": [
                        {
                            "latitude": 32.202814492736685,
                            "longitude": 34.98128005886077
                        },
                        {
                            "latitude": 32.1991467504968,
                            "longitude": 34.990614146232595
                        },
                        {
                            "latitude": 32.18824833176147,
                            "longitude": 34.995307006180276
                        },
                        {
                            "latitude": 32.18435817554951,
                            "longitude": 34.990113746613254
                        },
                        {
                            "latitude": 32.180227216454654,
                            "longitude": 34.9864278885126
                        },
                        {
                            "latitude": 32.17924905598918,
                            "longitude": 34.97769260430335
                        },
                        {
                            "latitude": 32.17613033671301,
                            "longitude": 34.97635820531844
                        },
                        {
                            "latitude": 32.16552816281645,
                            "longitude": 34.99253326678275
                        },
                        {
                            "latitude": 32.15594206352038,
                            "longitude": 34.996348709106435
                        },
                        {
                            "latitude": 32.154363867955574,
                            "longitude": 34.991869420051565
                        },
                        {
                            "latitude": 32.15554694949733,
                            "longitude": 34.988076776504506
                        },
                        {
                            "latitude": 32.159880620869714,
                            "longitude": 34.985236317157735
                        },
                        {
                            "latitude": 32.15985450819324,
                            "longitude": 34.9775035085678
                        },
                        {
                            "latitude": 32.18020650124181,
                            "longitude": 34.95932886028289
                        },
                        {
                            "latitude": 32.18982239356992,
                            "longitude": 34.958427638053884
                        },
                        {
                            "latitude": 32.198856229940404,
                            "longitude": 34.96284791851043
                        },
                        {
                            "latitude": 32.20013632918068,
                            "longitude": 34.968400091171254
                        },
                        {
                            "latitude": 32.200254351608095,
                            "longitude": 34.974638909339895
                        }
                    ],
                    "latitude": 32.196,
                    "longitude": 34.9815,
                    "distance": 5130987.561782608,
                    "name": "Qalqilya",
                    "countryId": 2,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 11,
                    "coordinates": [
                        {
                            "latitude": 32.242442095532326,
                            "longitude": 34.94126228931771
                        },
                        {
                            "latitude": 32.2374328719164,
                            "longitude": 34.93130592945443
                        },
                        {
                            "latitude": 32.22407359201194,
                            "longitude": 34.93010429981576
                        },
                        {
                            "latitude": 32.208061650993514,
                            "longitude": 34.91383938434945
                        },
                        {
                            "latitude": 32.197548877917825,
                            "longitude": 34.90991263035165
                        },
                        {
                            "latitude": 32.195308628724874,
                            "longitude": 34.90917502287255
                        },
                        {
                            "latitude": 32.193794670229735,
                            "longitude": 34.907750769885645
                        },
                        {
                            "latitude": 32.19134776951983,
                            "longitude": 34.90541724804269
                        },
                        {
                            "latitude": 32.190280918375265,
                            "longitude": 34.90728942993508
                        },
                        {
                            "latitude": 32.189214054725696,
                            "longitude": 34.91036324146615
                        },
                        {
                            "latitude": 32.18638113056235,
                            "longitude": 34.90988044384347
                        },
                        {
                            "latitude": 32.18365708187833,
                            "longitude": 34.91869418266641
                        },
                        {
                            "latitude": 32.18311226236039,
                            "longitude": 34.92167143467294
                        },
                        {
                            "latitude": 32.18761600578079,
                            "longitude": 34.92928890827523
                        },
                        {
                            "latitude": 32.189722518960906,
                            "longitude": 34.95585350635873
                        },
                        {
                            "latitude": 32.193935399067705,
                            "longitude": 34.96014504078256
                        },
                        {
                            "latitude": 32.199310169862464,
                            "longitude": 34.96323494556771
                        },
                        {
                            "latitude": 32.20079907048021,
                            "longitude": 34.97580914142953
                        },
                        {
                            "latitude": 32.20720832784535,
                            "longitude": 34.985186144145594
                        },
                        {
                            "latitude": 32.20744435419787,
                            "longitude": 34.98883394840585
                        },
                        {
                            "latitude": 32.21004968131801,
                            "longitude": 34.99058274868356
                        },
                        {
                            "latitude": 32.21327219523837,
                            "longitude": 34.99210624340402
                        },
                        {
                            "latitude": 32.223175037353776,
                            "longitude": 35.00508277061807
                        },
                        {
                            "latitude": 32.235508966247934,
                            "longitude": 35.01505522373544
                        },
                        {
                            "latitude": 32.23380282713917,
                            "longitude": 35.018381162913904
                        },
                        {
                            "latitude": 32.24904804053175,
                            "longitude": 35.02365975025521
                        },
                        {
                            "latitude": 32.24573392421622,
                            "longitude": 35.00602863275556
                        },
                        {
                            "latitude": 32.245250865782836,
                            "longitude": 34.99303237243364
                        },
                        {
                            "latitude": 32.248336024265356,
                            "longitude": 34.94548217101762
                        }
                    ],
                    "latitude": 32.2330108,
                    "longitude": 34.9776741,
                    "distance": 5133197.296577465,
                    "name": "Tira",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 12,
                    "coordinates": [
                        {
                            "latitude": 32.313192774258155,
                            "longitude": 34.963999633475346
                        },
                        {
                            "latitude": 32.31058133828203,
                            "longitude": 35.01292312590699
                        },
                        {
                            "latitude": 32.29598129920891,
                            "longitude": 35.01230085341553
                        },
                        {
                            "latitude": 32.29373043953715,
                            "longitude": 35.012295153721375
                        },
                        {
                            "latitude": 32.29378768949373,
                            "longitude": 35.012654234453244
                        },
                        {
                            "latitude": 32.293770684559895,
                            "longitude": 35.01290032713036
                        },
                        {
                            "latitude": 32.293627842989956,
                            "longitude": 35.013371054812474
                        },
                        {
                            "latitude": 32.29312449471143,
                            "longitude": 35.013196711226506
                        },
                        {
                            "latitude": 32.29211778977025,
                            "longitude": 35.0126549050055
                        },
                        {
                            "latitude": 32.29158268980101,
                            "longitude": 35.01237059084992
                        },
                        {
                            "latitude": 32.28313857557945,
                            "longitude": 35.009189490958256
                        },
                        {
                            "latitude": 32.28314727612932,
                            "longitude": 35.00953940136419
                        },
                        {
                            "latitude": 32.282321499659794,
                            "longitude": 35.01207799432627
                        },
                        {
                            "latitude": 32.281812813732515,
                            "longitude": 35.013378629957465
                        },
                        {
                            "latitude": 32.28130412495218,
                            "longitude": 35.014571977228066
                        },
                        {
                            "latitude": 32.28097721489285,
                            "longitude": 35.01574800801058
                        },
                        {
                            "latitude": 32.280523315008935,
                            "longitude": 35.016366139318
                        },
                        {
                            "latitude": 32.27998666731792,
                            "longitude": 35.01815201903987
                        },
                        {
                            "latitude": 32.27948629936961,
                            "longitude": 35.019852068073256
                        },
                        {
                            "latitude": 32.278721396406226,
                            "longitude": 35.020462668764544
                        },
                        {
                            "latitude": 32.27806533749487,
                            "longitude": 35.020794319718284
                        },
                        {
                            "latitude": 32.27703755961121,
                            "longitude": 35.022356957926554
                        },
                        {
                            "latitude": 32.27585279782378,
                            "longitude": 35.02260690627913
                        },
                        {
                            "latitude": 32.27449921086788,
                            "longitude": 35.02319263367276
                        },
                        {
                            "latitude": 32.27360625763153,
                            "longitude": 35.025737379475636
                        },
                        {
                            "latitude": 32.2714574642996,
                            "longitude": 35.0271361514769
                        },
                        {
                            "latitude": 32.26570819973889,
                            "longitude": 35.03040576426606
                        },
                        {
                            "latitude": 32.263353957897756,
                            "longitude": 35.029177312537236
                        },
                        {
                            "latitude": 32.26060499708,
                            "longitude": 35.0285228535376
                        },
                        {
                            "latitude": 32.259244094578825,
                            "longitude": 35.02609813658814
                        },
                        {
                            "latitude": 32.25484370352612,
                            "longitude": 35.023727063818974
                        },
                        {
                            "latitude": 32.249063896822264,
                            "longitude": 35.02375925032715
                        },
                        {
                            "latitude": 32.24309316076287,
                            "longitude": 35.019961242362065
                        },
                        {
                            "latitude": 32.23400019174264,
                            "longitude": 35.01929605452637
                        },
                        {
                            "latitude": 32.235361472572876,
                            "longitude": 35.0145109936438
                        },
                        {
                            "latitude": 32.23053337112717,
                            "longitude": 35.010949020072026
                        },
                        {
                            "latitude": 32.21739092360859,
                            "longitude": 34.996958617850346
                        },
                        {
                            "latitude": 32.21390531490555,
                            "longitude": 34.992495422049565
                        },
                        {
                            "latitude": 32.215793369538915,
                            "longitude": 34.9696644589148
                        },
                        {
                            "latitude": 32.23234847695085,
                            "longitude": 34.979277496024174
                        },
                        {
                            "latitude": 32.26501418103532,
                            "longitude": 34.97670257536988
                        },
                        {
                            "latitude": 32.28497077027364,
                            "longitude": 34.95524490325074
                        },
                        {
                            "latitude": 32.30641013857288,
                            "longitude": 34.9595793530188
                        }
                    ],
                    "latitude": 32.2615988,
                    "longitude": 35.0343007,
                    "distance": 5139365.113666353,
                    "name": "Taybeh - Qalansawe",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 17,
                    "coordinates": [
                        {
                            "latitude": 32.30471506904042,
                            "longitude": 35.01230743374765
                        },
                        {
                            "latitude": 32.30536357938906,
                            "longitude": 35.012399944967534
                        },
                        {
                            "latitude": 32.30859177933796,
                            "longitude": 35.01291492909839
                        },
                        {
                            "latitude": 32.31152970403664,
                            "longitude": 35.015125069326665
                        },
                        {
                            "latitude": 32.312980495907176,
                            "longitude": 35.01499632329395
                        },
                        {
                            "latitude": 32.33453229685214,
                            "longitude": 35.01628065618711
                        },
                        {
                            "latitude": 32.33535722799548,
                            "longitude": 35.017551567176035
                        },
                        {
                            "latitude": 32.33605524078269,
                            "longitude": 35.01884393583708
                        },
                        {
                            "latitude": 32.33675739533058,
                            "longitude": 35.020489921722316
                        },
                        {
                            "latitude": 32.3367882970521,
                            "longitude": 35.022345575994756
                        },
                        {
                            "latitude": 32.336888011917395,
                            "longitude": 35.02305367917469
                        },
                        {
                            "latitude": 32.33686046831174,
                            "longitude": 35.02388451242053
                        },
                        {
                            "latitude": 32.337313367801514,
                            "longitude": 35.026936214730746
                        },
                        {
                            "latitude": 32.33767108357933,
                            "longitude": 35.028358632522014
                        },
                        {
                            "latitude": 32.33854630136555,
                            "longitude": 35.03186639723791
                        },
                        {
                            "latitude": 32.33907235280053,
                            "longitude": 35.03441768839093
                        },
                        {
                            "latitude": 32.339852212737505,
                            "longitude": 35.03791311711719
                        },
                        {
                            "latitude": 32.34003350627301,
                            "longitude": 35.04216173619678
                        },
                        {
                            "latitude": 32.34016041153181,
                            "longitude": 35.04492977590015
                        },
                        {
                            "latitude": 32.340251058036245,
                            "longitude": 35.048341545767094
                        },
                        {
                            "latitude": 32.34030544589535,
                            "longitude": 35.04941442937305
                        },
                        {
                            "latitude": 32.340205734795454,
                            "longitude": 35.05095938176563
                        },
                        {
                            "latitude": 32.33999724759508,
                            "longitude": 35.051560196584965
                        },
                        {
                            "latitude": 32.33803925740649,
                            "longitude": 35.0522146555846
                        },
                        {
                            "latitude": 32.33600870431769,
                            "longitude": 35.05325535268238
                        },
                        {
                            "latitude": 32.33419567199143,
                            "longitude": 35.05396345586231
                        },
                        {
                            "latitude": 32.33256391184687,
                            "longitude": 35.05449453324726
                        },
                        {
                            "latitude": 32.32966293229219,
                            "longitude": 35.055068525976445
                        },
                        {
                            "latitude": 32.34572593852878,
                            "longitude": 35.1084069344466
                        },
                        {
                            "latitude": 32.34235403144925,
                            "longitude": 35.122005734152104
                        },
                        {
                            "latitude": 32.32798906806703,
                            "longitude": 35.1237977747547
                        },
                        {
                            "latitude": 32.31765082237225,
                            "longitude": 35.13336072465186
                        },
                        {
                            "latitude": 32.303921201896756,
                            "longitude": 35.13376483448817
                        },
                        {
                            "latitude": 32.302668490214714,
                            "longitude": 35.12970574852366
                        },
                        {
                            "latitude": 32.29570112469013,
                            "longitude": 35.11766082259688
                        },
                        {
                            "latitude": 32.292361072142945,
                            "longitude": 35.109392446963035
                        },
                        {
                            "latitude": 32.292716754128065,
                            "longitude": 35.10367216989337
                        },
                        {
                            "latitude": 32.29273311921395,
                            "longitude": 35.09889470377534
                        },
                        {
                            "latitude": 32.29318481450176,
                            "longitude": 35.092743946641725
                        },
                        {
                            "latitude": 32.295394163383676,
                            "longitude": 35.082502368897934
                        },
                        {
                            "latitude": 32.29974015002319,
                            "longitude": 35.07394967910851
                        },
                        {
                            "latitude": 32.304521204038146,
                            "longitude": 35.0669419417117
                        },
                        {
                            "latitude": 32.3051972668925,
                            "longitude": 35.061597278462685
                        },
                        {
                            "latitude": 32.30456751063538,
                            "longitude": 35.057282583475384
                        },
                        {
                            "latitude": 32.30014211191372,
                            "longitude": 35.05442871308354
                        },
                        {
                            "latitude": 32.29594322442011,
                            "longitude": 35.05314125275639
                        },
                        {
                            "latitude": 32.28740428203174,
                            "longitude": 35.060018436670575
                        },
                        {
                            "latitude": 32.277993735464094,
                            "longitude": 35.06007208085087
                        },
                        {
                            "latitude": 32.27962647861129,
                            "longitude": 35.05086673951176
                        },
                        {
                            "latitude": 32.28154944951504,
                            "longitude": 35.04209055161503
                        },
                        {
                            "latitude": 32.28483291879352,
                            "longitude": 35.03863586640385
                        },
                        {
                            "latitude": 32.285885055069464,
                            "longitude": 35.03320707535771
                        },
                        {
                            "latitude": 32.28525014670832,
                            "longitude": 35.02945198273686
                        },
                        {
                            "latitude": 32.28544968981511,
                            "longitude": 35.023336546182904
                        },
                        {
                            "latitude": 32.28546783007586,
                            "longitude": 35.019281046152386
                        },
                        {
                            "latitude": 32.2860845967792,
                            "longitude": 35.01597656464604
                        },
                        {
                            "latitude": 32.28612087704287,
                            "longitude": 35.014560358286175
                        },
                        {
                            "latitude": 32.285866914892274,
                            "longitude": 35.01318706727055
                        },
                        {
                            "latitude": 32.285813628100755,
                            "longitude": 35.012065903902325
                        },
                        {
                            "latitude": 32.2858759849814,
                            "longitude": 35.0113403663638
                        },
                        {
                            "latitude": 32.28584877471149,
                            "longitude": 35.011057393312726
                        },
                        {
                            "latitude": 32.285866914892296,
                            "longitude": 35.010837452173504
                        },
                        {
                            "latitude": 32.285871449937005,
                            "longitude": 35.01076100921658
                        },
                        {
                            "latitude": 32.28587144993698,
                            "longitude": 35.010687919020924
                        },
                        {
                            "latitude": 32.28586464736993,
                            "longitude": 35.010626898765835
                        },
                        {
                            "latitude": 32.28586237984749,
                            "longitude": 35.01054442083863
                        },
                        {
                            "latitude": 32.285864628626975,
                            "longitude": 35.01048829454997
                        },
                        {
                            "latitude": 32.28587144993698,
                            "longitude": 35.01041366314915
                        },
                        {
                            "latitude": 32.28586748177294,
                            "longitude": 35.01035213997987
                        },
                        {
                            "latitude": 32.28585897856366,
                            "longitude": 35.01020746833113
                        },
                        {
                            "latitude": 32.28709533681948,
                            "longitude": 35.01051609000591
                        },
                        {
                            "latitude": 32.28833621313967,
                            "longitude": 35.011044652819905
                        },
                        {
                            "latitude": 32.29371673756151,
                            "longitude": 35.013394938469204
                        },
                        {
                            "latitude": 32.293920796678165,
                            "longitude": 35.01221610760716
                        },
                        {
                            "latitude": 32.30190141515275,
                            "longitude": 35.01243604874638
                        },
                        {
                            "latitude": 32.30358813773587,
                            "longitude": 35.01250042176274
                        }
                    ],
                    "latitude": 32.3348164,
                    "longitude": 35.0272936,
                    "distance": 5143780.493090919,
                    "name": "Tulkarm",
                    "countryId": 2,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 38,
                    "coordinates": [
                        {
                            "latitude": 32.337563957938166,
                            "longitude": 35.08200491579714
                        },
                        {
                            "latitude": 32.34223148980783,
                            "longitude": 35.08747029385063
                        },
                        {
                            "latitude": 32.3480690446931,
                            "longitude": 35.09095571969169
                        },
                        {
                            "latitude": 32.35115792803544,
                            "longitude": 35.09967694325837
                        },
                        {
                            "latitude": 32.3630319853393,
                            "longitude": 35.11287075035739
                        },
                        {
                            "latitude": 32.373904439391175,
                            "longitude": 35.13434402329381
                        },
                        {
                            "latitude": 32.38908283906659,
                            "longitude": 35.1273082118621
                        },
                        {
                            "latitude": 32.3944149003677,
                            "longitude": 35.11740325402002
                        },
                        {
                            "latitude": 32.395125095008545,
                            "longitude": 35.08796369981951
                        },
                        {
                            "latitude": 32.411369759100786,
                            "longitude": 35.1173959408095
                        },
                        {
                            "latitude": 32.432966466844505,
                            "longitude": 35.0939851569035
                        },
                        {
                            "latitude": 32.44499734028081,
                            "longitude": 35.097353547802186
                        },
                        {
                            "latitude": 32.44355484159812,
                            "longitude": 35.08003674277802
                        },
                        {
                            "latitude": 32.443268191622046,
                            "longitude": 35.074811567805
                        },
                        {
                            "latitude": 32.4402289791118,
                            "longitude": 35.07078802247065
                        },
                        {
                            "latitude": 32.419015013810544,
                            "longitude": 35.06266735702752
                        },
                        {
                            "latitude": 32.42119848607465,
                            "longitude": 35.06011713417479
                        },
                        {
                            "latitude": 32.419499170401906,
                            "longitude": 35.056357785118735
                        },
                        {
                            "latitude": 32.41541946978644,
                            "longitude": 35.053835508055045
                        },
                        {
                            "latitude": 32.4110889182071,
                            "longitude": 35.055645726728244
                        },
                        {
                            "latitude": 32.40713844712003,
                            "longitude": 35.05511829285183
                        },
                        {
                            "latitude": 32.40326470163738,
                            "longitude": 35.05422703199088
                        },
                        {
                            "latitude": 32.40188213273036,
                            "longitude": 35.05473213595337
                        },
                        {
                            "latitude": 32.400730253720305,
                            "longitude": 35.054553234707555
                        },
                        {
                            "latitude": 32.39904170574452,
                            "longitude": 35.05321173205971
                        },
                        {
                            "latitude": 32.384629598413326,
                            "longitude": 35.04367985796648
                        },
                        {
                            "latitude": 32.376626999072386,
                            "longitude": 35.051081235627635
                        },
                        {
                            "latitude": 32.366161873617514,
                            "longitude": 35.05315423744264
                        },
                        {
                            "latitude": 32.3554977479307,
                            "longitude": 35.04437708038836
                        },
                        {
                            "latitude": 32.347679527896105,
                            "longitude": 35.04142012830357
                        },
                        {
                            "latitude": 32.342834758203686,
                            "longitude": 35.03684491884428
                        },
                        {
                            "latitude": 32.33498820733479,
                            "longitude": 35.041320226495145
                        },
                        {
                            "latitude": 32.33279795778678,
                            "longitude": 35.05506524850148
                        }
                    ],
                    "latitude": 32.3701,
                    "longitude": 35.0725,
                    "distance": 5149541.252754469,
                    "name": "Al-Sharawiya",
                    "countryId": 2,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 4,
                    "coordinates": [
                        {
                            "latitude": 32.33498058179393,
                            "longitude": 35.00991514995491
                        },
                        {
                            "latitude": 32.34665577251134,
                            "longitude": 35.041157520560375
                        },
                        {
                            "latitude": 32.36630439941557,
                            "longitude": 35.05077055766975
                        },
                        {
                            "latitude": 32.37596401276722,
                            "longitude": 35.04830292537605
                        },
                        {
                            "latitude": 32.37866417031917,
                            "longitude": 35.042402065543286
                        },
                        {
                            "latitude": 32.38179915134994,
                            "longitude": 35.0406210787574
                        },
                        {
                            "latitude": 32.38554331779439,
                            "longitude": 35.04312357976829
                        },
                        {
                            "latitude": 32.389287329057055,
                            "longitude": 35.04511109664833
                        },
                        {
                            "latitude": 32.39002342916839,
                            "longitude": 35.04696986749565
                        },
                        {
                            "latitude": 32.39376725472608,
                            "longitude": 35.0485282309333
                        },
                        {
                            "latitude": 32.39626984648099,
                            "longitude": 35.04863820150291
                        },
                        {
                            "latitude": 32.40312047812349,
                            "longitude": 35.0537692673484
                        },
                        {
                            "latitude": 32.4119451371898,
                            "longitude": 35.054995036868206
                        },
                        {
                            "latitude": 32.41209232074886,
                            "longitude": 35.05406431034004
                        },
                        {
                            "latitude": 32.41439741039926,
                            "longitude": 35.053777313975445
                        },
                        {
                            "latitude": 32.4166299852994,
                            "longitude": 35.05353323295509
                        },
                        {
                            "latitude": 32.41835532481359,
                            "longitude": 35.05468390062248
                        },
                        {
                            "latitude": 32.41914552835168,
                            "longitude": 35.056675440816036
                        },
                        {
                            "latitude": 32.42024874506682,
                            "longitude": 35.05728061422502
                        },
                        {
                            "latitude": 32.42236627203382,
                            "longitude": 35.05651249661838
                        },
                        {
                            "latitude": 32.42379547558403,
                            "longitude": 35.056431024519554
                        },
                        {
                            "latitude": 32.425959048562255,
                            "longitude": 35.05716276466643
                        },
                        {
                            "latitude": 32.42664235327298,
                            "longitude": 35.05821528024768
                        },
                        {
                            "latitude": 32.42980941502883,
                            "longitude": 35.059771506300024
                        },
                        {
                            "latitude": 32.43171890177948,
                            "longitude": 35.05977714312991
                        },
                        {
                            "latitude": 32.43437602462749,
                            "longitude": 35.06003745361028
                        },
                        {
                            "latitude": 32.43512503023675,
                            "longitude": 35.061154661767944
                        },
                        {
                            "latitude": 32.43654991529538,
                            "longitude": 35.06059746689658
                        },
                        {
                            "latitude": 32.43838515187817,
                            "longitude": 35.0628937901152
                        },
                        {
                            "latitude": 32.44300904689841,
                            "longitude": 35.06574238416448
                        },
                        {
                            "latitude": 32.45038504024047,
                            "longitude": 35.066531041690325
                        },
                        {
                            "latitude": 32.45398227820893,
                            "longitude": 35.07207521176184
                        },
                        {
                            "latitude": 32.455623930535786,
                            "longitude": 35.07315618603258
                        },
                        {
                            "latitude": 32.45813462769434,
                            "longitude": 35.0720913930914
                        },
                        {
                            "latitude": 32.4676094194086,
                            "longitude": 35.079884573403035
                        },
                        {
                            "latitude": 32.469045644306924,
                            "longitude": 35.07978133037483
                        },
                        {
                            "latitude": 32.473951543753316,
                            "longitude": 35.070854938773266
                        },
                        {
                            "latitude": 32.478024504388024,
                            "longitude": 35.05145720317756
                        },
                        {
                            "latitude": 32.4827127064646,
                            "longitude": 35.038668430594555
                        },
                        {
                            "latitude": 32.48041388885595,
                            "longitude": 35.022703922537914
                        },
                        {
                            "latitude": 32.4758251285331,
                            "longitude": 35.015515602378
                        },
                        {
                            "latitude": 32.47229967941813,
                            "longitude": 35.01260808780586
                        },
                        {
                            "latitude": 32.46957064262875,
                            "longitude": 35.0090139277259
                        },
                        {
                            "latitude": 32.469249307812426,
                            "longitude": 35.002973593024365
                        },
                        {
                            "latitude": 32.46892797184937,
                            "longitude": 35.00036648586189
                        },
                        {
                            "latitude": 32.4683577108381,
                            "longitude": 34.99892882182991
                        },
                        {
                            "latitude": 32.465135215673556,
                            "longitude": 34.99463728740608
                        }
                    ],
                    "latitude": 32.420559,
                    "longitude": 35.042827,
                    "distance": 5150732.814229132,
                    "name": "Baqa al-Gharbiyye",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 2,
                    "coordinates": [
                        {
                            "latitude": 32.45901166820693,
                            "longitude": 35.07348217551187
                        },
                        {
                            "latitude": 32.47569734629638,
                            "longitude": 35.09250947895798
                        },
                        {
                            "latitude": 32.481260674965874,
                            "longitude": 35.12606967793744
                        },
                        {
                            "latitude": 32.50553971483814,
                            "longitude": 35.162056331634055
                        },
                        {
                            "latitude": 32.52853587762139,
                            "longitude": 35.19020902812425
                        },
                        {
                            "latitude": 32.53635823180273,
                            "longitude": 35.17447098616213
                        },
                        {
                            "latitude": 32.53862497533996,
                            "longitude": 35.16546674518302
                        },
                        {
                            "latitude": 32.53968402945004,
                            "longitude": 35.15824527197672
                        },
                        {
                            "latitude": 32.54068386773012,
                            "longitude": 35.1552353501929
                        },
                        {
                            "latitude": 32.540478311836104,
                            "longitude": 35.15334415120285
                        },
                        {
                            "latitude": 32.539910972565565,
                            "longitude": 35.15128129083585
                        },
                        {
                            "latitude": 32.551967428521635,
                            "longitude": 35.12827087115418
                        },
                        {
                            "latitude": 32.5533354230573,
                            "longitude": 35.119032363671955
                        },
                        {
                            "latitude": 32.55544001785212,
                            "longitude": 35.099931137900946
                        },
                        {
                            "latitude": 32.55627425830252,
                            "longitude": 35.08181331127677
                        },
                        {
                            "latitude": 32.560101813975194,
                            "longitude": 35.07881704282742
                        },
                        {
                            "latitude": 32.56074630575757,
                            "longitude": 35.07290253096986
                        },
                        {
                            "latitude": 32.555432448262096,
                            "longitude": 35.03562079482041
                        },
                        {
                            "latitude": 32.54438283150517,
                            "longitude": 35.02550837963614
                        },
                        {
                            "latitude": 32.531518873774075,
                            "longitude": 35.0263024010068
                        },
                        {
                            "latitude": 32.52372959416311,
                            "longitude": 35.021246190795324
                        },
                        {
                            "latitude": 32.51917676084994,
                            "longitude": 35.02114475536055
                        },
                        {
                            "latitude": 32.514623696877464,
                            "longitude": 35.01881172202539
                        },
                        {
                            "latitude": 32.509728240821914,
                            "longitude": 35.013568247000336
                        },
                        {
                            "latitude": 32.484629476805395,
                            "longitude": 34.999293638968446
                        },
                        {
                            "latitude": 32.477073712233995,
                            "longitude": 34.98086959941786
                        },
                        {
                            "latitude": 32.470820745039234,
                            "longitude": 34.977551761039145
                        },
                        {
                            "latitude": 32.46579367458679,
                            "longitude": 34.98316315898912
                        },
                        {
                            "latitude": 32.45942653557226,
                            "longitude": 34.98692919713682
                        },
                        {
                            "latitude": 32.45588354061908,
                            "longitude": 34.99430012420053
                        },
                        {
                            "latitude": 32.4506194764951,
                            "longitude": 35.0276384090992
                        },
                        {
                            "latitude": 32.4492763443267,
                            "longitude": 35.037975379878304
                        }
                    ],
                    "latitude": 32.501181,
                    "longitude": 35.068407,
                    "distance": 5158092.062140224,
                    "name": "Kfar Qaree - Arara",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 1,
                    "coordinates": [
                        {
                            "latitude": 32.54208240332566,
                            "longitude": 35.103390676879876
                        },
                        {
                            "latitude": 32.555901140385295,
                            "longitude": 35.140340788269036
                        },
                        {
                            "latitude": 32.5580623865723,
                            "longitude": 35.14333681573867
                        },
                        {
                            "latitude": 32.558270369861454,
                            "longitude": 35.146332843208306
                        },
                        {
                            "latitude": 32.56082038665272,
                            "longitude": 35.15069411506652
                        },
                        {
                            "latitude": 32.56186026631495,
                            "longitude": 35.15478448381423
                        },
                        {
                            "latitude": 32.56264694987784,
                            "longitude": 35.15878902187347
                        },
                        {
                            "latitude": 32.56262886527567,
                            "longitude": 35.16370819320678
                        },
                        {
                            "latitude": 32.576462516165236,
                            "longitude": 35.16911503741817
                        },
                        {
                            "latitude": 32.57977471594704,
                            "longitude": 35.18538336916486
                        },
                        {
                            "latitude": 32.572196752974506,
                            "longitude": 35.191577809085224
                        },
                        {
                            "latitude": 32.546604475522585,
                            "longitude": 35.204306108856194
                        },
                        {
                            "latitude": 32.543667627529274,
                            "longitude": 35.20886488978527
                        },
                        {
                            "latitude": 32.5360767393912,
                            "longitude": 35.19737528076171
                        },
                        {
                            "latitude": 32.523169453546025,
                            "longitude": 35.187212148514895
                        },
                        {
                            "latitude": 32.524715529767725,
                            "longitude": 35.18025205841064
                        },
                        {
                            "latitude": 32.51776784021477,
                            "longitude": 35.175574285888665
                        },
                        {
                            "latitude": 32.50341021120025,
                            "longitude": 35.15923914578985
                        },
                        {
                            "latitude": 32.494985059687515,
                            "longitude": 35.14501856079101
                        },
                        {
                            "latitude": 32.4960363943476,
                            "longitude": 35.14359455140316
                        },
                        {
                            "latitude": 32.4962650935778,
                            "longitude": 35.13943566321637
                        },
                        {
                            "latitude": 32.49232540296783,
                            "longitude": 35.138932384937156
                        },
                        {
                            "latitude": 32.48935962726052,
                            "longitude": 35.13359137599132
                        },
                        {
                            "latitude": 32.48819508335336,
                            "longitude": 35.13055316135529
                        },
                        {
                            "latitude": 32.48508539728736,
                            "longitude": 35.12647473943894
                        },
                        {
                            "latitude": 32.483292019486115,
                            "longitude": 35.12370718693369
                        },
                        {
                            "latitude": 32.47964633184469,
                            "longitude": 35.11834862575875
                        },
                        {
                            "latitude": 32.475039014723286,
                            "longitude": 35.10714089228082
                        },
                        {
                            "latitude": 32.478373265022256,
                            "longitude": 35.10061239553857
                        },
                        {
                            "latitude": 32.474795880477224,
                            "longitude": 35.091555801548616
                        },
                        {
                            "latitude": 32.46637709256019,
                            "longitude": 35.08274059589262
                        },
                        {
                            "latitude": 32.482831279927574,
                            "longitude": 35.034556416133505
                        },
                        {
                            "latitude": 32.4903701035226,
                            "longitude": 35.02727397571385
                        },
                        {
                            "latitude": 32.49975093956811,
                            "longitude": 35.02741979005173
                        },
                        {
                            "latitude": 32.516930599020895,
                            "longitude": 35.02833564001144
                        },
                        {
                            "latitude": 32.518102571949086,
                            "longitude": 35.07637546768188
                        },
                        {
                            "latitude": 32.52724840796076,
                            "longitude": 35.07588194122314
                        },
                        {
                            "latitude": 32.53396018982553,
                            "longitude": 35.08061335792541
                        },
                        {
                            "latitude": 32.53850076052363,
                            "longitude": 35.08706138839721
                        }
                    ],
                    "latitude": 32.530785271958,
                    "longitude": 35.153601629639,
                    "distance": 5166444.648921411,
                    "name": "Umm al-Fahem",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 23,
                    "coordinates": [
                        {
                            "latitude": 32.51247101416389,
                            "longitude": 35.287832810704195
                        },
                        {
                            "latitude": 32.5152756500315,
                            "longitude": 35.28624494296738
                        },
                        {
                            "latitude": 32.54210525759756,
                            "longitude": 35.2841420910997
                        },
                        {
                            "latitude": 32.53497801132133,
                            "longitude": 35.25899369937607
                        },
                        {
                            "latitude": 32.5521258601523,
                            "longitude": 35.24268586856552
                        },
                        {
                            "latitude": 32.5570272276331,
                            "longitude": 35.23307283145615
                        },
                        {
                            "latitude": 32.56532819509854,
                            "longitude": 35.22423227054306
                        },
                        {
                            "latitude": 32.59355297040139,
                            "longitude": 35.24169881564804
                        },
                        {
                            "latitude": 32.61179218704956,
                            "longitude": 35.25178392154404
                        },
                        {
                            "latitude": 32.657473337069554,
                            "longitude": 35.27641732913681
                        },
                        {
                            "latitude": 32.66238700757588,
                            "longitude": 35.302338197056734
                        },
                        {
                            "latitude": 32.66484374153337,
                            "longitude": 35.31392534000107
                        },
                        {
                            "latitude": 32.64829561151119,
                            "longitude": 35.3676553509874
                        },
                        {
                            "latitude": 32.63794244015766,
                            "longitude": 35.374607636754
                        },
                        {
                            "latitude": 32.62831092752917,
                            "longitude": 35.377955033604586
                        },
                        {
                            "latitude": 32.62566795316992,
                            "longitude": 35.3801008008165
                        },
                        {
                            "latitude": 32.62273574157475,
                            "longitude": 35.377955033604586
                        },
                        {
                            "latitude": 32.618931404029375,
                            "longitude": 35.37555177432724
                        },
                        {
                            "latitude": 32.61807743906088,
                            "longitude": 35.37336309177109
                        },
                        {
                            "latitude": 32.62069352821784,
                            "longitude": 35.36241967899033
                        },
                        {
                            "latitude": 32.614760905273265,
                            "longitude": 35.35808522922226
                        },
                        {
                            "latitude": 32.59975702555155,
                            "longitude": 35.354491069142306
                        },
                        {
                            "latitude": 32.593085756359564,
                            "longitude": 35.35016198379227
                        },
                        {
                            "latitude": 32.590825355114696,
                            "longitude": 35.34746368152329
                        },
                        {
                            "latitude": 32.58164022905724,
                            "longitude": 35.36540765983292
                        },
                        {
                            "latitude": 32.57657718774342,
                            "longitude": 35.366869463746035
                        },
                        {
                            "latitude": 32.57006722385171,
                            "longitude": 35.367472960774386
                        },
                        {
                            "latitude": 32.55988557569041,
                            "longitude": 35.36599506360718
                        },
                        {
                            "latitude": 32.5522349456204,
                            "longitude": 35.32941241485306
                        },
                        {
                            "latitude": 32.53359007429039,
                            "longitude": 35.318914919321024
                        },
                        {
                            "latitude": 32.53114101023492,
                            "longitude": 35.31907350492903
                        },
                        {
                            "latitude": 32.53027827633429,
                            "longitude": 35.319303001437866
                        },
                        {
                            "latitude": 32.52572201597762,
                            "longitude": 35.326370035458886
                        },
                        {
                            "latitude": 32.52217872443038,
                            "longitude": 35.32863055092522
                        },
                        {
                            "latitude": 32.51835188436125,
                            "longitude": 35.32497335893341
                        },
                        {
                            "latitude": 32.51410655583973,
                            "longitude": 35.311248830680334
                        },
                        {
                            "latitude": 32.5146380412818,
                            "longitude": 35.30885395330616
                        },
                        {
                            "latitude": 32.514615352759435,
                            "longitude": 35.305094166819536
                        },
                        {
                            "latitude": 32.51040603800739,
                            "longitude": 35.30208238137194
                        },
                        {
                            "latitude": 32.50999659957773,
                            "longitude": 35.29840540808865
                        }
                    ],
                    "latitude": 32.613548,
                    "longitude": 35.304989,
                    "distance": 5183319.994890731,
                    "name": "Afula",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 7,
                    "coordinates": [
                        {
                            "latitude": 32.83281680607849,
                            "longitude": 35.13848756527625
                        },
                        {
                            "latitude": 32.831230157011206,
                            "longitude": 35.13505433773719
                        },
                        {
                            "latitude": 32.831230157011206,
                            "longitude": 35.131878602263555
                        },
                        {
                            "latitude": 32.814857168156145,
                            "longitude": 35.1013228771659
                        },
                        {
                            "latitude": 32.808148420245416,
                            "longitude": 35.09681676602088
                        },
                        {
                            "latitude": 32.796352780818594,
                            "longitude": 35.10095809673987
                        },
                        {
                            "latitude": 32.800862002088984,
                            "longitude": 35.12372468685828
                        },
                        {
                            "latitude": 32.77668990417102,
                            "longitude": 35.17063115811072
                        },
                        {
                            "latitude": 32.764204428019205,
                            "longitude": 35.16243432736121
                        },
                        {
                            "latitude": 32.74269354787129,
                            "longitude": 35.18698190426551
                        },
                        {
                            "latitude": 32.75934147466923,
                            "longitude": 35.21361087536536
                        },
                        {
                            "latitude": 32.75973169362122,
                            "longitude": 35.21932398056708
                        },
                        {
                            "latitude": 32.76012191086312,
                            "longitude": 35.22057388996802
                        },
                        {
                            "latitude": 32.76419315060538,
                            "longitude": 35.22783194756232
                        },
                        {
                            "latitude": 32.76783117020931,
                            "longitude": 35.22908185696326
                        },
                        {
                            "latitude": 32.7848081323395,
                            "longitude": 35.23135637020789
                        },
                        {
                            "latitude": 32.790021448230334,
                            "longitude": 35.22135709500037
                        },
                        {
                            "latitude": 32.79379144130033,
                            "longitude": 35.20689462399207
                        },
                        {
                            "latitude": 32.83278074618733,
                            "longitude": 35.214533555266485
                        },
                        {
                            "latitude": 32.83743235125027,
                            "longitude": 35.20998452877723
                        },
                        {
                            "latitude": 32.84071356946413,
                            "longitude": 35.20547841763221
                        },
                        {
                            "latitude": 32.84341777901862,
                            "longitude": 35.19822572445594
                        },
                        {
                            "latitude": 32.83202348508871,
                            "longitude": 35.14046167111121
                        }
                    ],
                    "latitude": 32.804818,
                    "longitude": 35.173452,
                    "distance": 5186469.311610847,
                    "name": "Shefa-Amr - I'billin",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 10,
                    "coordinates": [
                        {
                            "latitude": 32.73537336383113,
                            "longitude": 35.30801213194974
                        },
                        {
                            "latitude": 32.736167547186426,
                            "longitude": 35.307840470572785
                        },
                        {
                            "latitude": 32.73688952591371,
                            "longitude": 35.30702507903226
                        },
                        {
                            "latitude": 32.7398856751297,
                            "longitude": 35.30676758696683
                        },
                        {
                            "latitude": 32.742087600090194,
                            "longitude": 35.307325486441925
                        },
                        {
                            "latitude": 32.74306220524154,
                            "longitude": 35.30812746693738
                        },
                        {
                            "latitude": 32.7437480321058,
                            "longitude": 35.308843616744355
                        },
                        {
                            "latitude": 32.75176098636281,
                            "longitude": 35.30795848776944
                        },
                        {
                            "latitude": 32.76654876903928,
                            "longitude": 35.312897775670365
                        },
                        {
                            "latitude": 32.764013637228366,
                            "longitude": 35.33259994198926
                        },
                        {
                            "latitude": 32.762407715671955,
                            "longitude": 35.375265840789154
                        },
                        {
                            "latitude": 32.72634805586389,
                            "longitude": 35.36495945264943
                        },
                        {
                            "latitude": 32.72241273554497,
                            "longitude": 35.36443776299603
                        },
                        {
                            "latitude": 32.716419161761216,
                            "longitude": 35.36134115268834
                        },
                        {
                            "latitude": 32.71251951193721,
                            "longitude": 35.35232222487576
                        },
                        {
                            "latitude": 32.71313787056287,
                            "longitude": 35.345525507232026
                        },
                        {
                            "latitude": 32.723520690196445,
                            "longitude": 35.344680611392334
                        },
                        {
                            "latitude": 32.72299943422388,
                            "longitude": 35.34432924201138
                        },
                        {
                            "latitude": 32.72290014702645,
                            "longitude": 35.343824986716584
                        },
                        {
                            "latitude": 32.72339658190797,
                            "longitude": 35.343760613700226
                        },
                        {
                            "latitude": 32.72322959957447,
                            "longitude": 35.34335291792996
                        },
                        {
                            "latitude": 32.723026512531206,
                            "longitude": 35.342773560782746
                        },
                        {
                            "latitude": 32.719127151607076,
                            "longitude": 35.33968365599759
                        },
                        {
                            "latitude": 32.709161343533054,
                            "longitude": 35.337795380851105
                        },
                        {
                            "latitude": 32.698833280871675,
                            "longitude": 35.33161557128079
                        },
                        {
                            "latitude": 32.693343754124086,
                            "longitude": 35.32801068236478
                        },
                        {
                            "latitude": 32.69161014922377,
                            "longitude": 35.33215201308377
                        },
                        {
                            "latitude": 32.68684256216755,
                            "longitude": 35.33783829619534
                        },
                        {
                            "latitude": 32.674416745232186,
                            "longitude": 35.33367550780423
                        },
                        {
                            "latitude": 32.672032524567555,
                            "longitude": 35.319341782828644
                        },
                        {
                            "latitude": 32.67448899335001,
                            "longitude": 35.31118786742337
                        },
                        {
                            "latitude": 32.67636742390292,
                            "longitude": 35.30663884093411
                        },
                        {
                            "latitude": 32.675428213563826,
                            "longitude": 35.29702580382474
                        },
                        {
                            "latitude": 32.67275502239727,
                            "longitude": 35.28646862914212
                        },
                        {
                            "latitude": 32.67022625443138,
                            "longitude": 35.278400544425324
                        },
                        {
                            "latitude": 32.670804264847945,
                            "longitude": 35.27050412108548
                        },
                        {
                            "latitude": 32.67011787706198,
                            "longitude": 35.250934724112824
                        },
                        {
                            "latitude": 32.663298869925306,
                            "longitude": 35.24748003890164
                        },
                        {
                            "latitude": 32.66168210186152,
                            "longitude": 35.24921811034329
                        },
                        {
                            "latitude": 32.660824028718835,
                            "longitude": 35.24333870818265
                        },
                        {
                            "latitude": 32.66162790801202,
                            "longitude": 35.23479855467923
                        },
                        {
                            "latitude": 32.675446275394165,
                            "longitude": 35.23029244353421
                        },
                        {
                            "latitude": 32.68449479317969,
                            "longitude": 35.22660172392972
                        },
                        {
                            "latitude": 32.68826925316788,
                            "longitude": 35.232416753074006
                        },
                        {
                            "latitude": 32.69522178810861,
                            "longitude": 35.24578488280423
                        },
                        {
                            "latitude": 32.69933887819728,
                            "longitude": 35.26432431151517
                        },
                        {
                            "latitude": 32.699700017390704,
                            "longitude": 35.266384248038605
                        },
                        {
                            "latitude": 32.70049451847229,
                            "longitude": 35.26655590941556
                        },
                        {
                            "latitude": 32.70670582856523,
                            "longitude": 35.26827252318509
                        },
                        {
                            "latitude": 32.70865580185819,
                            "longitude": 35.25659954955228
                        },
                        {
                            "latitude": 32.716310840456906,
                            "longitude": 35.250419739981965
                        },
                        {
                            "latitude": 32.72808098587264,
                            "longitude": 35.25496876647122
                        },
                        {
                            "latitude": 32.72974167885644,
                            "longitude": 35.25900280882962
                        },
                        {
                            "latitude": 32.72793657632509,
                            "longitude": 35.26647007872708
                        },
                        {
                            "latitude": 32.72959727199898,
                            "longitude": 35.2744523327554
                        },
                        {
                            "latitude": 32.727358935795735,
                            "longitude": 35.28518116881497
                        },
                        {
                            "latitude": 32.72901964222991,
                            "longitude": 35.28827107360013
                        },
                        {
                            "latitude": 32.73369472572528,
                            "longitude": 35.30771172454007
                        },
                        {
                            "latitude": 32.734145975634895,
                            "longitude": 35.30775463988431
                        }
                    ],
                    "latitude": 32.6943626,
                    "longitude": 35.2974173,
                    "distance": 5188206.916773534,
                    "name": "Nazareth area",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 24,
                    "coordinates": [
                        {
                            "latitude": 32.946814809096075,
                            "longitude": 35.07404227703763
                        },
                        {
                            "latitude": 32.96979744793527,
                            "longitude": 35.07553358524991
                        },
                        {
                            "latitude": 32.990429917026354,
                            "longitude": 35.081858234107024
                        },
                        {
                            "latitude": 32.98845462870913,
                            "longitude": 35.095564322173125
                        },
                        {
                            "latitude": 32.9871047479408,
                            "longitude": 35.10198016613675
                        },
                        {
                            "latitude": 32.981579020808,
                            "longitude": 35.111013846098906
                        },
                        {
                            "latitude": 32.96225425603912,
                            "longitude": 35.10591764897061
                        },
                        {
                            "latitude": 32.947030889934645,
                            "longitude": 35.10245223492337
                        },
                        {
                            "latitude": 32.93943172983896,
                            "longitude": 35.10219474285794
                        },
                        {
                            "latitude": 32.93183191667637,
                            "longitude": 35.10090728253079
                        },
                        {
                            "latitude": 32.91807135205109,
                            "longitude": 35.10047812908841
                        },
                        {
                            "latitude": 32.898471462009965,
                            "longitude": 35.10940452068997
                        },
                        {
                            "latitude": 32.88712027759187,
                            "longitude": 35.10914702862454
                        },
                        {
                            "latitude": 32.88059719306222,
                            "longitude": 35.09635825604153
                        },
                        {
                            "latitude": 32.88290375296094,
                            "longitude": 35.07520099133206
                        },
                        {
                            "latitude": 32.904524832291,
                            "longitude": 35.08116622418118
                        },
                        {
                            "latitude": 32.91194685251399,
                            "longitude": 35.08065124005032
                        },
                        {
                            "latitude": 32.91760302293277,
                            "longitude": 35.07891316860867
                        },
                        {
                            "latitude": 32.91940427520836,
                            "longitude": 35.077561335265166
                        },
                        {
                            "latitude": 32.92096514323448,
                            "longitude": 35.074131125211245
                        },
                        {
                            "latitude": 32.92126515546356,
                            "longitude": 35.07327583581162
                        },
                        {
                            "latitude": 32.92145090361334,
                            "longitude": 35.07212315648747
                        },
                        {
                            "latitude": 32.92110192191911,
                            "longitude": 35.07131983488751
                        },
                        {
                            "latitude": 32.920674136029376,
                            "longitude": 35.07091482132626
                        },
                        {
                            "latitude": 32.92030488759858,
                            "longitude": 35.07042665928555
                        },
                        {
                            "latitude": 32.92010675365913,
                            "longitude": 35.07040520161343
                        },
                        {
                            "latitude": 32.919638435311505,
                            "longitude": 35.07123668640805
                        },
                        {
                            "latitude": 32.919242164004835,
                            "longitude": 35.071212546526915
                        },
                        {
                            "latitude": 32.918575703714744,
                            "longitude": 35.070630507170684
                        },
                        {
                            "latitude": 32.918679275575656,
                            "longitude": 35.06878514736844
                        },
                        {
                            "latitude": 32.91901700906272,
                            "longitude": 35.066875414549834
                        },
                        {
                            "latitude": 32.91891794070676,
                            "longitude": 35.06646771877957
                        },
                        {
                            "latitude": 32.91913408970409,
                            "longitude": 35.065888361632354
                        },
                        {
                            "latitude": 32.919467318373975,
                            "longitude": 35.06578107327176
                        },
                        {
                            "latitude": 32.946814809096075,
                            "longitude": 35.07052321881009
                        }
                    ],
                    "latitude": 32.933005,
                    "longitude": 35.081448,
                    "distance": 5188373.648027986,
                    "name": "Acre",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 13,
                    "coordinates": [
                        {
                            "latitude": 32.87192347509784,
                            "longitude": 35.23584898875847
                        },
                        {
                            "latitude": 32.867958547108515,
                            "longitude": 35.223746861683274
                        },
                        {
                            "latitude": 32.86309225681043,
                            "longitude": 35.220957364307786
                        },
                        {
                            "latitude": 32.85494512873003,
                            "longitude": 35.222502316700364
                        },
                        {
                            "latitude": 32.84079402422155,
                            "longitude": 35.21618303226128
                        },
                        {
                            "latitude": 32.84142050619941,
                            "longitude": 35.207876230942155
                        },
                        {
                            "latitude": 32.842263320301996,
                            "longitude": 35.1989686148037
                        },
                        {
                            "latitude": 32.84261486606514,
                            "longitude": 35.197032059894944
                        },
                        {
                            "latitude": 32.83630485854418,
                            "longitude": 35.18770870135918
                        },
                        {
                            "latitude": 32.83608850747668,
                            "longitude": 35.187676514851
                        },
                        {
                            "latitude": 32.83597582442022,
                            "longitude": 35.18764432834282
                        },
                        {
                            "latitude": 32.83559270095847,
                            "longitude": 35.187526311146165
                        },
                        {
                            "latitude": 32.835387616543706,
                            "longitude": 35.18738683627739
                        },
                        {
                            "latitude": 32.83309559695265,
                            "longitude": 35.184264744984056
                        },
                        {
                            "latitude": 32.83223015823871,
                            "longitude": 35.18216189311638
                        },
                        {
                            "latitude": 32.831653194409895,
                            "longitude": 35.18035944865837
                        },
                        {
                            "latitude": 32.831635164229816,
                            "longitude": 35.17922219203606
                        },
                        {
                            "latitude": 32.83100410562151,
                            "longitude": 35.17765578197136
                        },
                        {
                            "latitude": 32.8308598630242,
                            "longitude": 35.177269543873216
                        },
                        {
                            "latitude": 32.83374467045244,
                            "longitude": 35.150576199757005
                        },
                        {
                            "latitude": 32.89343912794596,
                            "longitude": 35.180273617969895
                        },
                        {
                            "latitude": 32.895565181860974,
                            "longitude": 35.22391852306023
                        },
                        {
                            "latitude": 32.894808456655184,
                            "longitude": 35.22936877177849
                        },
                        {
                            "latitude": 32.89129500494935,
                            "longitude": 35.25340136455193
                        },
                        {
                            "latitude": 32.88770933878308,
                            "longitude": 35.25408801005974
                        },
                        {
                            "latitude": 32.88290269684489,
                            "longitude": 35.25457080768242
                        },
                        {
                            "latitude": 32.88411451775148,
                            "longitude": 35.243681039081956
                        },
                        {
                            "latitude": 32.88390729304607,
                            "longitude": 35.23627814220085
                        },
                        {
                            "latitude": 32.87484299054002,
                            "longitude": 35.23503359721794
                        }
                    ],
                    "latitude": 32.8503213,
                    "longitude": 35.1947306,
                    "distance": 5191133.725303162,
                    "name": "Tamra - Kabul",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 16,
                    "coordinates": [
                        {
                            "latitude": 32.99869194684474,
                            "longitude": 35.153290254888084
                        },
                        {
                            "latitude": 32.99691303255917,
                            "longitude": 35.1291474853662
                        },
                        {
                            "latitude": 32.98096665077282,
                            "longitude": 35.1251134430078
                        },
                        {
                            "latitude": 32.969842074084276,
                            "longitude": 35.11657328950438
                        },
                        {
                            "latitude": 32.914436844728684,
                            "longitude": 35.12877738347347
                        },
                        {
                            "latitude": 32.91227521628698,
                            "longitude": 35.15675818791683
                        },
                        {
                            "latitude": 32.89498028864303,
                            "longitude": 35.16173636784847
                        },
                        {
                            "latitude": 32.89563750651645,
                            "longitude": 35.18120139009086
                        },
                        {
                            "latitude": 32.89650232670126,
                            "longitude": 35.206607273879925
                        },
                        {
                            "latitude": 32.91163531303921,
                            "longitude": 35.20875304109184
                        },
                        {
                            "latitude": 32.93529566496499,
                            "longitude": 35.20734690130939
                        },
                        {
                            "latitude": 32.93536092663403,
                            "longitude": 35.20716384883773
                        },
                        {
                            "latitude": 32.935604049029884,
                            "longitude": 35.20694390769851
                        },
                        {
                            "latitude": 32.935851135149164,
                            "longitude": 35.20682585535169
                        },
                        {
                            "latitude": 32.93634241665384,
                            "longitude": 35.20661667819869
                        },
                        {
                            "latitude": 32.93785515058268,
                            "longitude": 35.20639137264144
                        },
                        {
                            "latitude": 32.9465978855359,
                            "longitude": 35.19548014636886
                        },
                        {
                            "latitude": 32.95287078287245,
                            "longitude": 35.19108937021148
                        },
                        {
                            "latitude": 32.96022348326944,
                            "longitude": 35.1936508798207
                        },
                        {
                            "latitude": 32.96772634294125,
                            "longitude": 35.20109132762801
                        },
                        {
                            "latitude": 32.96885077157205,
                            "longitude": 35.19698965025842
                        },
                        {
                            "latitude": 32.97371953079751,
                            "longitude": 35.18773813158024
                        },
                        {
                            "latitude": 32.970783833326855,
                            "longitude": 35.20970426384053
                        },
                        {
                            "latitude": 32.97186393922136,
                            "longitude": 35.2109058934792
                        },
                        {
                            "latitude": 32.980288311863696,
                            "longitude": 35.21373830619893
                        },
                        {
                            "latitude": 32.99241943627466,
                            "longitude": 35.212794168625685
                        },
                        {
                            "latitude": 33.00134572699229,
                            "longitude": 35.20635686698994
                        }
                    ],
                    "latitude": 32.945098,
                    "longitude": 35.176891,
                    "distance": 5196250.133690835,
                    "name": "Judaydah Almaker - Yarka - Yassif",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 5,
                    "coordinates": [
                        {
                            "latitude": 32.88585973364028,
                            "longitude": 35.26400434893797
                        },
                        {
                            "latitude": 32.89515713426958,
                            "longitude": 35.27995414087785
                        },
                        {
                            "latitude": 32.898400184013,
                            "longitude": 35.29950882173378
                        },
                        {
                            "latitude": 32.90394912704014,
                            "longitude": 35.31906350258967
                        },
                        {
                            "latitude": 32.90488592727226,
                            "longitude": 35.3381031993147
                        },
                        {
                            "latitude": 32.90531829326753,
                            "longitude": 35.362650776219
                        },
                        {
                            "latitude": 32.898904647745695,
                            "longitude": 35.395180607151616
                        },
                        {
                            "latitude": 32.89969737066336,
                            "longitude": 35.428397083592046
                        },
                        {
                            "latitude": 32.87778678063579,
                            "longitude": 35.43680849106275
                        },
                        {
                            "latitude": 32.826881422270546,
                            "longitude": 35.4106301310774
                        },
                        {
                            "latitude": 32.82637654871791,
                            "longitude": 35.399944210362065
                        },
                        {
                            "latitude": 32.836834057701616,
                            "longitude": 35.37792863876783
                        },
                        {
                            "latitude": 32.827025671329835,
                            "longitude": 35.307547474217046
                        },
                        {
                            "latitude": 32.82096700912491,
                            "longitude": 35.25604906113111
                        },
                        {
                            "latitude": 32.82147191342608,
                            "longitude": 35.246865177464116
                        },
                        {
                            "latitude": 32.83524748042055,
                            "longitude": 35.228411579441655
                        },
                        {
                            "latitude": 32.858754767949634,
                            "longitude": 35.23132982284986
                        },
                        {
                            "latitude": 32.87187575950239,
                            "longitude": 35.249727022417375
                        }
                    ],
                    "latitude": 32.856139,
                    "longitude": 35.328282,
                    "distance": 5201433.824836611,
                    "name": "Sakhnin - Arraba - Deir Hanna",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                },
                {
                    "areaId": 19,
                    "coordinates": [
                        {
                            "latitude": 32.93718027013307,
                            "longitude": 35.2349845472389
                        },
                        {
                            "latitude": 32.93854892231241,
                            "longitude": 35.229405552487925
                        },
                        {
                            "latitude": 32.93788260744984,
                            "longitude": 35.21600791845854
                        },
                        {
                            "latitude": 32.93447892078087,
                            "longitude": 35.19608715210493
                        },
                        {
                            "latitude": 32.92769817047472,
                            "longitude": 35.191920340400294
                        },
                        {
                            "latitude": 32.91947592617391,
                            "longitude": 35.20251640711363
                        },
                        {
                            "latitude": 32.911676245847005,
                            "longitude": 35.21083393726881
                        },
                        {
                            "latitude": 32.90808840083941,
                            "longitude": 35.21298506889875
                        },
                        {
                            "latitude": 32.90241060259929,
                            "longitude": 35.22432008419569
                        },
                        {
                            "latitude": 32.89360044830646,
                            "longitude": 35.2459708753639
                        },
                        {
                            "latitude": 32.8836812056668,
                            "longitude": 35.25492408905561
                        },
                        {
                            "latitude": 32.86885883554859,
                            "longitude": 35.25975742970045
                        },
                        {
                            "latitude": 32.869995755932784,
                            "longitude": 35.26860603724058
                        },
                        {
                            "latitude": 32.87142101579426,
                            "longitude": 35.27745464478071
                        },
                        {
                            "latitude": 32.892363225992426,
                            "longitude": 35.281848103147105
                        },
                        {
                            "latitude": 32.88991276571541,
                            "longitude": 35.324076801877574
                        },
                        {
                            "latitude": 32.901659944126344,
                            "longitude": 35.35042682323988
                        },
                        {
                            "latitude": 32.90504687797211,
                            "longitude": 35.36613383923109
                        },
                        {
                            "latitude": 32.91873741777284,
                            "longitude": 35.36304393444593
                        },
                        {
                            "latitude": 32.926734595387366,
                            "longitude": 35.375489384275035
                        },
                        {
                            "latitude": 32.93401067850321,
                            "longitude": 35.38939395580824
                        },
                        {
                            "latitude": 32.94387926047736,
                            "longitude": 35.38656154308851
                        },
                        {
                            "latitude": 32.94863307477141,
                            "longitude": 35.37385860119398
                        },
                        {
                            "latitude": 32.951009886060305,
                            "longitude": 35.36287227306898
                        },
                        {
                            "latitude": 32.94495969526238,
                            "longitude": 35.31274715099867
                        },
                        {
                            "latitude": 32.94798484241958,
                            "longitude": 35.29849925671156
                        },
                        {
                            "latitude": 32.94748065841522,
                            "longitude": 35.28922954235609
                        },
                        {
                            "latitude": 32.948416997848966,
                            "longitude": 35.280131489377574
                        },
                        {
                            "latitude": 32.94294287298413,
                            "longitude": 35.256098896604136
                        }
                    ],
                    "latitude": 32.918856826609,
                    "longitude": 35.306203313666,
                    "distance": 5204042.007137869,
                    "name": "Karmiel - Shaghur",
                    "countryId": 1,
                    "isNew": false,
                    "isReadyArea": false,
                    "isMarketReady": false,
                    "isRestaurantReady": false
                }
            ]



        
    }
}
