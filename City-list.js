var CityList = [{name:'Auckland',arealist:['city','East','South','West','North Shore']},
    {name: 'Wellington',arealist: ['Wellington City','Porirua City','Lower Hutt City','Upper Hutt City','Kapiti Coast District','Masterton District','Carterton District','South Wairarapa District']},
    {name:'Christchurch',arealist: ['Akaroa','Avondale','Beckenham','Belfast','Bishopdale','Burwood','Cashmere']},
    {name: 'Bay of Plenty',arealist: []}
]



var cityArray = new Array();
var areaArray = new Array();

var areaTag = document.getElementById("area");
var cityList;
var areaList;
var cityArray = new Array();
var areaArray = new Array();

function getCity(){
    var cityTag = document.getElementById("city");
    var i
    for(i=0; i<CityList.length; i++){　　　　//provinceList.length为省数组的长度，下标从0开始，所以定义var i=0
        var C = CityList[i];　　　　　　　　　　//通过下标获取省列表（上面的列出列表）中的数据
        var cityName = C.name;　　　　　　　　//根据 province.name获取省的名字
        cityArray[i]=cityName;　　　　　　　　　　　//将获得城市的名字注入到数组中去
        cityTag.add(new Option(cityName,i.toString()));　　　　//通过Option方法将省的名字与下标i对应，取出来。然后通过add()方法，将每一个名字放到provinceTag中
    }
}

function chooseCity(th){
    var areaTag = document.getElementById("area");
    var index = th.selectedIndex-1
    var city_name = cityArray[index]
    var n
    for(n = 0;n<CityList.length;n++){
        var city =  CityList[n]
        if(city.name === city_name){
            areaList = city.arealist;
            areaTag.innerHTML=""
            for(var c=0;c<areaList.length;c++){
                var area = areaList[c];
                areaArray[c] = area;
                areaTag.add(new Option(area,c.toString()))

            }

        }

    }


}





// Akaroa
// Avondale
// Beckenham
// Belfast
// Bishopdale
// Burwood
// Cashmere
// Dallington
// Edgeware
// Fendalton
// Halswell
// Hornby
// Linwood
// Lyttelton
// Merivale
// New Brighton
// 奥克兰（Auckland）
// 惠灵顿（Wellington）
// 基督城（Christchurch）
// 汉密尔顿（Hamilton）
// 辛迪加（Tauranga）
// 达尼丁（Dunedin）
// 罗托鲁瓦（Rotorua）
// 新普利茅斯（New Plymouth）
// 内皮尔（Napier）
// 莱斯特顿（Levin）
// 帕默斯顿北（Palmerston North）
// 格雷茅斯（Greymouth）
// 北帕玛斯顿（North Palmerston）
// 北帕帕鲁阿（Paparoa）
// 艾灵顿（Ailingdun）