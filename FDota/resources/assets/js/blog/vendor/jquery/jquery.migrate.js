var originalInit = jQuery.fn.init

jQuery.fn.init = function (selector, context) {
    var ret = originalInit.apply(this, arguments)

    if (selector && selector.selector !== undefined) {
        ret.selector = selector.selector
        ret.context = selector.context
    } else {
        ret.selector = typeof selector === 'string' ? selector : ''
        if (selector) {
            ret.context = selector.nodeType ? selector : context || document
        }
    }

    return ret
}

jQuery.fn.init.prototype = jQuery.fn