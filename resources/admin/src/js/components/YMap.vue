<template>
    <div :id="ymapId" style="width: 100%; height: 400px"></div>
</template>

<script>
    import {debounce} from 'lodash';

    export default {
        props: {
            lat: Number,
            lon: Number,
        },
        mounted() {
            this.$on('setAddress', (val) => {
                this.address = val;
                this.searchByAddress();
            });

            const $vm = this;
            ymaps.ready(() => {
                $vm.ymap = new ymaps.Map(this.ymapId, {
                    center: [55.7537, 37.6198],
                    zoom: 9,

                });

                $vm.ymap.behaviors.disable('scrollZoom');

                if ($vm.lat && $vm.lon) {
                    this.updateAddress();
                }

                // Слушаем клик на карте.
                $vm.ymap.events.add('click', (e) => {
                    const coords = e.get('coords');

                    $vm.setPlacemark(coords);
                    $vm.getAddress(coords);
                });

                $(`#${$vm.ymapId}`).on('click', '.js_address_save', () => {
                    const [lat, lon] = $vm.placemark.geometry.getCoordinates();
                    $vm.$emit('addressChanged', {
                        address: $vm.address,
                        lat,
                        lon,
                    });
                });
            });
        },
        data() {
            return {
                ymapId: 'yandexMap' + Math.round(Math.random() * 100000),
                address: '',
                ymap: null,
                placemark: null,
            }
        },
        watch: {
            lat() {
                if (this.ymap && this.lon)
                    this.updateAddress();
            },
            lon() {
                if (this.ymap && this.lat)
                    this.updateAddress();
            },
        },
        computed: {
            coords() {
                return [this.lat, this.lon];
            }
        },
        methods: {
            // Создание метки.
            createPlacemark(coords) {
                return new ymaps.Placemark(coords, {
                    iconCaption: 'поиск...'
                }, {
                    preset: 'islands#violetDotIconWithCaption',
                    draggable: true
                });
            },
            setPlacemark(coords) {
                this.ymap.setCenter(coords);
                // Если метка уже создана – просто передвигаем ее.
                if (this.placemark) {
                    this.placemark.geometry.setCoordinates(coords);
                }
                // Если нет – создаем.
                else {
                    this.placemark = this.createPlacemark(coords);
                    this.ymap.geoObjects.add(this.placemark);
                    // Слушаем событие окончания перетаскивания на метке.
                    this.placemark.events.add('dragend', () => {
                        this.getAddress(this.placemark.geometry.getCoordinates());
                    });
                }
            },
            // Определяем адрес по координатам (обратное геокодирование).
            getAddress(coords) {
                this.placemark.properties.set('iconCaption', 'поиск...');
                ymaps.geocode(coords).then(res => {
                    const firstGeoObject = res.geoObjects.get(0);
                    this.placemark.properties.set({
                        iconCaption: firstGeoObject.properties.get('name'),
                        balloonContent: firstGeoObject.properties.get('text') + '<br><button type="button" class="btn btn-xs btn-success js_address_save">Сохранить</button>'
                    });

                    this.address = firstGeoObject.properties.get('text');
                });
            },
            searchByAddress() {
                ymaps.geocode(this.address).then(res => {
                        const coords = res.geoObjects.get(0).geometry.getCoordinates();
                        this.setPlacemark(coords);
                        this.getAddress(coords);
                    },
                    err => {
                        alert('Ошибка');
                    });
            },
            updateAddress() {
                this.setPlacemark(this.coords);
                this.getAddress(this.coords);
            }
        }
    }
</script>
