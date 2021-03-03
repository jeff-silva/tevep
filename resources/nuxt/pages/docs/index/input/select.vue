<template><div>
    <div class="mb-4" v-for="s in selects">
        <div class="p-1 mb-2">{{ s.title }}</div>
        <ui-code :value="getCode(s)"></ui-code>
        <div class="mb-2"></div>
        <ui-select v-model="s.value" v-bind="s.bind">
            <ui-select-item :value="u" v-for="(u, uindex) in users" :key="u.login.uuid">
                <div class="d-flex align-items-center">
                    <div><img :src="u.picture.medium" alt="" width="50px"></div>
                    <div class="flex-grw-1 pl-3">
                        <div>{{ u.name.title }} {{ u.name.first }} {{ u.name.last }}</div>
                        <div class="text-muted">{{ u.email }}</div>
                    </div>
                </div>
            </ui-select-item>
        </ui-select>
    </div>
</div></template>

<script>
export default {
    methods: {
        getCode(item) {
            return [
                `<ui-select v-model="value" v-bind='${JSON.stringify(item.bind)}'>`,
                `\t<ui-select-item value="1">Item 1</ui-select-item>`,
                `\t<ui-select-item value="2">Item 2</ui-select-item>`,
                `\t<ui-select-item value="3">Item 3</ui-select-item>`,
                '</ui-select>',
            ].join("\n");
        },
    },

    data() {
        return {
            selects: [
                {
                    title: "Valor único",
                    value: false,
                    bind: {},
                },
                {
                    title: "Valor múltiplo",
                    value: false,
                    bind: {multiple:true},
                },
                {
                    title: "Altura máxima 200px",
                    value: false,
                    bind: {maxHeight:'200PX'},
                },
                {
                    title: "Sem dropdown",
                    value: false,
                    bind: {dropdown:false},
                },
                {
                    title: "Com filtro pre definido",
                    value: false,
                    bind: {filter:'miss'},
                },
                {
                    title: "Mensagem customizada de seleções vazias",
                    value: false,
                    bind: {empty:"Sem nada"},
                },
            ],

            user1: false,
            user2: false,
            users: [{"gender":"male","name":{"title":"Mr","first":"Dwayne","last":"Hughes"},"location":{"street":{"number":825,"name":"Albert Road"},"city":"Preston","state":"Suffolk","country":"United Kingdom","postcode":"U6 1JT","coordinates":{"latitude":"15.2946","longitude":"-123.8598"},"timezone":{"offset":"+2:00","description":"Kaliningrad, South Africa"}},"email":"dwayne.hughes@example.com","login":{"uuid":"47810ad7-1193-496e-8a29-cf096d4c7895","username":"bluemeercat791","password":"nature","salt":"gfKoMA5X","md5":"d3ec68f6db7064a62d8006d3c3cdf5a4","sha1":"3d8af77c34b22408e2b715a0f07d7931a6d925de","sha256":"5cf7fb83627fafd5d1e61fefbb880a34d8bf865a230e86eff12b5bc11c8039f5"},"dob":{"date":"1997-03-16T22:07:45.926Z","age":24},"registered":{"date":"2003-02-12T20:05:12.708Z","age":18},"phone":"0117091 954 2031","cell":"0715-808-170","id":{"name":"NINO","value":"OT 16 32 55 W"},"picture":{"large":"https://randomuser.me/api/portraits/men/59.jpg","medium":"https://randomuser.me/api/portraits/med/men/59.jpg","thumbnail":"https://randomuser.me/api/portraits/thumb/men/59.jpg"},"nat":"GB"},{"gender":"male","name":{"title":"Mr","first":"Ray","last":"Gordon"},"location":{"street":{"number":6233,"name":"Karen Dr"},"city":"Concord","state":"Florida","country":"United States","postcode":10240,"coordinates":{"latitude":"-16.0476","longitude":"-63.4954"},"timezone":{"offset":"-2:00","description":"Mid-Atlantic"}},"email":"ray.gordon@example.com","login":{"uuid":"a4d24adb-0f1f-4864-8637-a9086d65eebb","username":"smallladybug305","password":"jennaj","salt":"KNbzvAwV","md5":"10ebb2eebb1d59d6999fa27abd8b8c1a","sha1":"cadc42bd4bfba1740caa79643d3995170b9d3f49","sha256":"c73136212bcb4caad434eed30f42329112447eea380568ce3b41dc2de58ad90e"},"dob":{"date":"1963-06-06T22:22:29.207Z","age":58},"registered":{"date":"2012-05-29T02:50:54.830Z","age":9},"phone":"(253)-950-1265","cell":"(219)-007-7101","id":{"name":"SSN","value":"340-77-6404"},"picture":{"large":"https://randomuser.me/api/portraits/men/20.jpg","medium":"https://randomuser.me/api/portraits/med/men/20.jpg","thumbnail":"https://randomuser.me/api/portraits/thumb/men/20.jpg"},"nat":"US"},{"gender":"male","name":{"title":"Mr","first":"Lucas","last":"Thomas"},"location":{"street":{"number":3457,"name":"Taieri Road"},"city":"Auckland","state":"West Coast","country":"New Zealand","postcode":30806,"coordinates":{"latitude":"45.7360","longitude":"-30.6243"},"timezone":{"offset":"-9:00","description":"Alaska"}},"email":"lucas.thomas@example.com","login":{"uuid":"905794bb-3d10-4881-8262-0767fab5d8fa","username":"bigwolf180","password":"birthday4","salt":"MSPFJKez","md5":"912db9d8cca8b478882226681bac069f","sha1":"54e2a1d4faaeda53604cbb85f0cd262f1e820020","sha256":"6fb54005785eccb7a717f69474cc2a505f2c75bee0060f97fdff67bbbff5b88a"},"dob":{"date":"1988-08-20T12:16:49.680Z","age":33},"registered":{"date":"2006-04-06T07:20:53.114Z","age":15},"phone":"(225)-303-8522","cell":"(165)-823-4299","id":{"name":"","value":null},"picture":{"large":"https://randomuser.me/api/portraits/men/92.jpg","medium":"https://randomuser.me/api/portraits/med/men/92.jpg","thumbnail":"https://randomuser.me/api/portraits/thumb/men/92.jpg"},"nat":"NZ"},{"gender":"female","name":{"title":"Ms","first":"Concepcion","last":"Vidal"},"location":{"street":{"number":805,"name":"Calle de Alcalá"},"city":"Arrecife","state":"Asturias","country":"Spain","postcode":63305,"coordinates":{"latitude":"69.2300","longitude":"-124.7152"},"timezone":{"offset":"-4:00","description":"Atlantic Time (Canada), Caracas, La Paz"}},"email":"concepcion.vidal@example.com","login":{"uuid":"6e0ddaf7-973e-47de-9801-09862828dfc6","username":"crazyswan770","password":"titanium","salt":"Zmu6NhVi","md5":"b4ca12163be605ea8c999e99b8dd4e1d","sha1":"7d737544a16e05eedd1e7770a1a3381388f04a2a","sha256":"665085d6a15d11531501bcfa25cdf55c692cfc11a54bff0c96d589c59db7425b"},"dob":{"date":"1981-05-23T12:53:37.952Z","age":40},"registered":{"date":"2004-12-26T06:58:45.540Z","age":17},"phone":"937-356-536","cell":"631-857-469","id":{"name":"DNI","value":"25236064-X"},"picture":{"large":"https://randomuser.me/api/portraits/women/91.jpg","medium":"https://randomuser.me/api/portraits/med/women/91.jpg","thumbnail":"https://randomuser.me/api/portraits/thumb/women/91.jpg"},"nat":"ES"},{"gender":"female","name":{"title":"Mrs","first":"Lascívia","last":"da Cruz"},"location":{"street":{"number":7440,"name":"Rua Dezesseis de Maio"},"city":"Rio das Ostras","state":"Santa Catarina","country":"Brazil","postcode":99553,"coordinates":{"latitude":"38.1833","longitude":"42.2910"},"timezone":{"offset":"+8:00","description":"Beijing, Perth, Singapore, Hong Kong"}},"email":"lascivia.dacruz@example.com","login":{"uuid":"218d1c2c-1ca1-45b2-809e-68029b48f627","username":"tinybird297","password":"chocolate","salt":"5iR3zuRO","md5":"f506eb7c118a01c85f4c0d0b80bb9123","sha1":"ad6117bc47774c41a13376e189eafa8eee14fb27","sha256":"ca1cbca9724da4cee24f9b579e23966124adda4846c1fab06f52a8c757f19584"},"dob":{"date":"1987-02-18T16:39:22.536Z","age":34},"registered":{"date":"2010-04-21T23:18:35.876Z","age":11},"phone":"(74) 6227-3565","cell":"(52) 3186-0091","id":{"name":"","value":null},"picture":{"large":"https://randomuser.me/api/portraits/women/94.jpg","medium":"https://randomuser.me/api/portraits/med/women/94.jpg","thumbnail":"https://randomuser.me/api/portraits/thumb/women/94.jpg"},"nat":"BR"},{"gender":"female","name":{"title":"Miss","first":"Graciliana","last":"Ramos"},"location":{"street":{"number":7246,"name":"Rua Dois"},"city":"Marituba","state":"Rio de Janeiro","country":"Brazil","postcode":44690,"coordinates":{"latitude":"74.0976","longitude":"126.1690"},"timezone":{"offset":"+5:00","description":"Ekaterinburg, Islamabad, Karachi, Tashkent"}},"email":"graciliana.ramos@example.com","login":{"uuid":"646d1b10-6b16-4e29-82b5-498df6c56963","username":"lazybear706","password":"eeeeeee","salt":"ZjgHGfc5","md5":"4d607863497511b19248ce8d83483621","sha1":"c26dbe3094df55f8fd0b3a20bec2947a91fd1bb9","sha256":"5de275852218a703c08ab924b73e9a9aacc72a042caf96e382b25bb28665f397"},"dob":{"date":"1973-09-06T04:59:20.726Z","age":48},"registered":{"date":"2011-05-02T10:06:41.238Z","age":10},"phone":"(59) 3054-6741","cell":"(88) 4692-5863","id":{"name":"","value":null},"picture":{"large":"https://randomuser.me/api/portraits/women/5.jpg","medium":"https://randomuser.me/api/portraits/med/women/5.jpg","thumbnail":"https://randomuser.me/api/portraits/thumb/women/5.jpg"},"nat":"BR"},{"gender":"female","name":{"title":"Ms","first":"Kelly","last":"Lawrence"},"location":{"street":{"number":2643,"name":"Sunset St"},"city":"Hervey Bay","state":"Northern Territory","country":"Australia","postcode":1248,"coordinates":{"latitude":"-59.6343","longitude":"-179.0374"},"timezone":{"offset":"-6:00","description":"Central Time (US & Canada), Mexico City"}},"email":"kelly.lawrence@example.com","login":{"uuid":"9a06565c-7c73-4593-894f-8034b932e11b","username":"smallpanda600","password":"buttman","salt":"OZVyMAzL","md5":"9fc5352144af0a4e8dddf01f1a5f24b5","sha1":"787b42d6db7d19dce7d0c0e77f49d03ebfa7294b","sha256":"77c9e8432dab5b4c5fe4f0c9685037b96d5d64238163d4d799da6040678cf3a3"},"dob":{"date":"1965-12-20T23:06:05.587Z","age":56},"registered":{"date":"2003-11-14T03:39:29.603Z","age":18},"phone":"07-1725-8872","cell":"0450-226-486","id":{"name":"TFN","value":"056544028"},"picture":{"large":"https://randomuser.me/api/portraits/women/12.jpg","medium":"https://randomuser.me/api/portraits/med/women/12.jpg","thumbnail":"https://randomuser.me/api/portraits/thumb/women/12.jpg"},"nat":"AU"},{"gender":"male","name":{"title":"Mr","first":"Marceau","last":"Lucas"},"location":{"street":{"number":2253,"name":"Place de L'Abbé-Georges-Hénocque"},"city":"Rouen","state":"Drôme","country":"France","postcode":36189,"coordinates":{"latitude":"47.0730","longitude":"-122.0380"},"timezone":{"offset":"-5:00","description":"Eastern Time (US & Canada), Bogota, Lima"}},"email":"marceau.lucas@example.com","login":{"uuid":"11570bca-707d-40bb-95d0-f39ba8991621","username":"lazywolf559","password":"webster","salt":"u1xFI3mO","md5":"508e26cb3792d3766749c838e1cd7044","sha1":"ebfff654df5dcf30825e6dbaffdceb01406ba165","sha256":"9b6a25fbda88c857eb1de7813868fad87b2d7ee095211cc4d31efef3c00dc8cd"},"dob":{"date":"1963-10-24T15:24:07.606Z","age":58},"registered":{"date":"2019-05-31T11:12:46.549Z","age":2},"phone":"04-90-95-26-36","cell":"06-17-63-58-15","id":{"name":"INSEE","value":"1NNaN41455662 11"},"picture":{"large":"https://randomuser.me/api/portraits/men/38.jpg","medium":"https://randomuser.me/api/portraits/med/men/38.jpg","thumbnail":"https://randomuser.me/api/portraits/thumb/men/38.jpg"},"nat":"FR"},{"gender":"male","name":{"title":"Mr","first":"Liam","last":"Bouchard"},"location":{"street":{"number":7150,"name":"St. Catherine St"},"city":"Campbellton","state":"Prince Edward Island","country":"Canada","postcode":"V7B 9E5","coordinates":{"latitude":"79.2343","longitude":"-147.6382"},"timezone":{"offset":"0:00","description":"Western Europe Time, London, Lisbon, Casablanca"}},"email":"liam.bouchard@example.com","login":{"uuid":"d3e43950-5d83-432b-8d35-64ee6c3ff414","username":"sadmeercat270","password":"wildbill","salt":"fwoGp5ZP","md5":"39728bb7c0e17fd1371f24997fa3624d","sha1":"45c67cfb104b9a29986ace60952e55891e85378c","sha256":"3b770d13dfac454f36048a4001a0a406098d46711d0b9668b795410738e48234"},"dob":{"date":"1957-12-07T23:41:22.896Z","age":64},"registered":{"date":"2015-06-29T06:16:37.204Z","age":6},"phone":"031-817-0556","cell":"990-185-4225","id":{"name":"","value":null},"picture":{"large":"https://randomuser.me/api/portraits/men/93.jpg","medium":"https://randomuser.me/api/portraits/med/men/93.jpg","thumbnail":"https://randomuser.me/api/portraits/thumb/men/93.jpg"},"nat":"CA"},{"gender":"female","name":{"title":"Miss","first":"هلیا","last":"سهيلي راد"},"location":{"street":{"number":1072,"name":"موحد دانش"},"city":"خوی","state":"قم","country":"Iran","postcode":64854,"coordinates":{"latitude":"-74.2951","longitude":"-134.1910"},"timezone":{"offset":"-8:00","description":"Pacific Time (US & Canada)"}},"email":"hly.shylyrd@example.com","login":{"uuid":"9d35ea1c-2e4d-4ba2-b6c4-8a85a63e8c7a","username":"ticklishrabbit811","password":"goth","salt":"52RMpPRs","md5":"f98dea9613a96c3f847c8b7634c49904","sha1":"d30c0ad9be0b66b27cb66b01926968b55539948c","sha256":"e591ad9c966ce992ca2e7d0659d593f37ff9a90a724c1519713f0dc59fb9d9f0"},"dob":{"date":"1989-08-30T09:01:45.653Z","age":32},"registered":{"date":"2011-02-02T13:22:38.661Z","age":10},"phone":"078-18073901","cell":"0991-325-3702","id":{"name":"","value":null},"picture":{"large":"https://randomuser.me/api/portraits/women/60.jpg","medium":"https://randomuser.me/api/portraits/med/women/60.jpg","thumbnail":"https://randomuser.me/api/portraits/thumb/women/60.jpg"},"nat":"IR"}],
        };
    },
}
</script>