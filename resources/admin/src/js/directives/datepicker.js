const Datepicker = {
    bind: function (el) {
        $(el).datepicker({
            orientation: 'bottom',
            format: 'dd.mm.yyyy',
        }).on('changeDate', (e) => {
            el.value = e.format('dd.mm.yyyy');
            el.dispatchEvent(new CustomEvent('input'));
        });
    }
};

export default Datepicker;
