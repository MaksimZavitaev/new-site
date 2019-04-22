const Timepicker = {
    bind: function (el) {
        $(el).timepicker({
            minuteStep: 1,
            showInputs: false,
            appendWidgetTo: 'body',
            showMeridian: false,
            defaultTime: '12:00'
        }).on('changeTime.timepicker', (e) => {
            el.value = e.time.value;
            el.dispatchEvent(new CustomEvent('input'));
        });
    }
};

export default Timepicker;
