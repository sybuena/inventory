/*! jQuery-Ajax-File-Upload 2013-11-20 */ ! function(a) {
    function b(b, e) {
        this.element = b, this.$form = a(b), this.$uploaders = a("input[type=file]", this.element), this.files = {}, this.settings = a.extend({}, d, e), this._defaults = d, this._name = c, this.init()
    }
    var c = "fileUpload",
        d = {
            uploadData: {},
            submitData: {},
            uploadOptions: {},
            submitOptions: {},
            before: function() {},
            beforeSubmit: function() {
                return !0
            },
            success: function() {},
            error: function() {},
            complete: function() {}
        };
    b.prototype = {
        init: function() {
            this.$uploaders.on("change", {
                context: this
            }, this.processFiles), this.$form.on("submit", {
                context: this
            }, this.uploadFiles)
        },
        processFiles: function(b) {
            var c = b.data.context;
            c.files[a(b.target).attr("name")] = b.target.files
        },
        uploadFiles: function(b) {
            b.stopPropagation(), b.preventDefault();
            var c = b.data.context;
            c.settings.before();
            var d = new FormData;

            d.append("file_upload_incoming", "1"), a.each(c.files, function(b, c) {
                a.each(c, function(a, b) {
                    d.append(a, b)
                })
            }), a.each(c.settings.uploadData, function(a, b) {
                d.append(a, b)
            }), a.ajax(a.extend({}, {
                url: c.$form.attr("action"),
                type: "POST",
                data: d,
                cache: !1,
                dataType: "json",
                processData: !1,
                contentType: !1,
                success: function(a) {
                    c.processSubmit(b, a)
                },
                error: function(a, b, d) {
                    c.settings.error(a, b, d)
                }
            }, c.settings.uploadOptions))
        },
        processSubmit: function(b, c) {
            var d = b.data.context;
            if (d.settings.beforeSubmit(c)) {
                var e = d.$form.serializeArray();
                a.each(c, function(a, b) {
                    e.push({
                        name: a,
                        value: b
                    })
                }), a.each(d.settings.submitData, function(a, b) {
                    e.push({
                        name: a,
                        value: b
                    })
                }), a.ajax(a.extend({}, {
                    url: d.$form.attr("action"),
                    type: "POST",
                    data: e,
                    cache: !1,
                    dataType: "json",
                    success: function(a, b, c) {
                        d.settings.success(a, b, c)
                    },
                    error: function(a, b, c) {
                        d.settings.error(a, b, c)
                    },
                    complete: function(a, b) {
                        d.settings.complete(a, b)
                    }
                }, d.settings.submitOptions))
            }
        }
    }, a.fn[c] = function(d) {
        return this.each(function() {
            a.data(this, "plugin_" + c) || a.data(this, "plugin_" + c, new b(this, d))
        })
    }
}(jQuery, window, document);