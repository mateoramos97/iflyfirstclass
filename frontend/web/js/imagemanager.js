$(document).ready(function () {

    $(function () {

        var CreateGUID = function () {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
                var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }

        $(".imagemanager-unorderedstyle-component").each(function () {

            var self = $(this),
                dropZone = self.find(".dropzone").first(),
                config = $.parseJSON(self.find(">.config").first().html()),
                pathUpload = config.Route,
                fineUploaderConfig = {
                    multiple: true,
                    autoUpload: true,
                    debug: false,
                    validation: {
                        allowedExtensions: ['jpeg', 'jpg', 'png', 'bmp']
                    },
                    request: {
                        endpoint: pathUpload,
                        inputName: "upload_file"
                    },
                    button: dropZone
                },
                listObj = self.find(".sortable").first(),
                lastListItem = listObj.children("li").last(),
                lastListItemComponents = lastListItem.find(".components-wrapper").first(),
                listItemClone = null,
                listItemComponentsClone = null,
                fileUploader = self.children('.fineuploader-component').first(),
                apiFileUploader = fileUploader.fineUploader(fineUploaderConfig),
                apiDragAndDrop = dropZone.fineUploaderDnd(),
                regName = /\[.*?\]/;

            listItemComponentsClone = lastListItemComponents.clone();
            lastListItemComponents.remove();
            listItemClone = lastListItem.clone();
            lastListItem.remove();

            var InitSortableComponent = function (ignoreLastItem) {
                //console.log(listObj);
                var listItems = ignoreLastItem ? listObj.children("li:not(:last)") : listObj.children("li");
                listObj.sortable({
                    items: listItems,
                    stop: function (event, ui) {
                        ChangeQueueValues();
                    }
                });
            }

            var ChangeQueueValues = function () {
                listObj.children("li").each(function (ind) {
                    var obj = $(this).find(".file-queue");
                    if (obj.length > 0)
                        obj.val(ind);
                });
            }

            var UploadFile = function (uploader, params) {
                //uploader.fineUploader('setEndpoint', pathUpload);
                uploader.fineUploader('setParams', params);
                //fileUploader.fineUploader('uploadStoredFiles');
            }

            var ManageItem = function (item) {
                var fileAddWrapper = item.find(".file-add-wrapper").first(),
                    fileAddedWrapper = item.find(".file-added-wrapper").first(),
                    linkReplace = fileAddedWrapper.find(".replace-link").first(),
                    linkDelete = fileAddedWrapper.find(".delete-link").first(),
                    linkRotate = fileAddedWrapper.find(".rotate-link").first();

                if (config.EnableReplaceButton) {
                    linkReplace.click(function () {
                        ShowItemAddWrapper(item);
                        return false;
                    });
                }
                else
                    linkReplace.hide();

                if (config.EnableDeleteButton) {
                    linkDelete.click(function () {
                        ShowItemProcessWrapper(item);
                        SendRequestToDeleteFile(item, function () {
                            item.remove();
                            ChangeQueueValues();
                        }, function () {
                            ShowItemAddedWrapper(item);
                        });
                        return false;
                    });
                }
                else
                    linkDelete.hide();

                if (config.EnableRotateButton) {
                    linkRotate.click(function () {
                        ShowItemProcessWrapper(item);
                        SendRequestToRotateFile(item, function () {
                            var img = item.find('.addedimg').first(),
                                galleryLink = item.find('.gallery-link').first(),
                                d = new Date();
                            img.attr("src", img.attr("src") + "?" + d.getTime());
                            galleryLink.attr('href', img.attr("src"));
                            ShowItemAddedWrapper(item);
                        }, function () {
                            ShowItemAddedWrapper(item);
                        });
                        return false;
                    });
                }
                else
                    linkRotate.hide();
            }

            var SendRequestToRotateFile = function (item, callbackDone, callbackFail) {
                var params = {
                    content_id: config.ContentID,
                    content_field_id: config.ContentFieldID,
                    alias_to_rotate: item.find(".file-alias").val()
                }
                $.ajax({
                    type: "POST",
                    url: pathUpload,
                    data: params,
                    cache: false,
                    dataType: "json"
                }).done(function (data, textStatus, jqXHR) {
                    //console.log(data);
                    if (data.success) {
                        //location.reload();
                        callbackDone();
                    }
                    else {
                        callbackFail();
                        if (data.error) {
                            alert(data.error);
                        }
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    callbackFail();
                });
            }

            var SendRequestToDeleteFile = function (item, callbackDone, callbackFail) {
                var params = {
                    content_id: config.ContentID,
                    content_field_id: config.ContentFieldID,
                    alias_to_remove: item.find(".file-alias").val()
                }
                $.ajax({
                    type: "POST",
                    url: pathUpload,
                    data: params,
                    cache: false,
                    dataType: "json"
                }).done(function (data, textStatus, jqXHR) {
                    if (data.success)
                        callbackDone();
                    else
                    {
                        callbackFail();
                        if (data.error) {
                            alert(data.error);
                        }
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    callbackFail();
                });
            }

            var AddComponents = function (item) {
                var obj = listItemComponentsClone.clone(),
                    list = obj.find(".file-alias").add(obj.find(".file-title")).add(obj.find(".file-queue")),
                    key = CreateGUID();
                list.each(function () {
                    var self = $(this);
                    self.attr({
                        "name": self.attr("name").replace(regName, "[" + key + "]")
                    });
                });
                item.append(obj);
            }

            var RemoveComponents = function (item) {
                item.find(".components-wrapper").remove();
            }

            var ExistComponents = function (item) {
                if (item.find(".components-wrapper").length > 0)
                    return true;
                return false;
            }

            var GetFileAliasValue = function (item) {
                var obj = item.find(".file-alias");
                if (obj.length > 0)
                    return obj.val();
                return null;
            }

            var IsFileAliasNullOrEmpty = function (item) {
                var v = GetFileAliasValue(item);
                if (v != null && v != "")
                    return false;
                return true;
            }

            var ShowItemProcessWrapper = function (item) {
                item.find(".file-added-wrapper").first().addClass("hidden");
                item.find(".file-add-wrapper").first().addClass("hidden");
                item.find(".file-process-wrapper").first().removeClass("hidden");
            }

            var ShowItemAddWrapper = function (item) {
                item.find(".file-added-wrapper").first().addClass("hidden");
                item.find(".file-process-wrapper").first().addClass("hidden");
                item.find(".file-add-wrapper").first().removeClass("hidden");
            }

            var ShowItemAddedWrapper = function (item) {
                item.find(".file-add-wrapper").first().addClass("hidden");
                item.find(".file-process-wrapper").first().addClass("hidden");
                item.find(".file-added-wrapper").first().removeClass("hidden");
            }

            var GetItemByClass = function (className) {
                var obj = null;
                listObj.children("li").each(function () {
                    if (!$(this).find("." + className).first().hasClass("hidden")) {
                        obj = $(this);
                        return false;
                    }
                });
                return obj;
            }

            var GetFreeItemAdd = function () {
                return GetItemByClass("file-add-wrapper");
            }

            var GetFreeItemProcess = function () {
                return GetItemByClass("file-process-wrapper");
            }

            var AddItem = function () {
                var cln = listItemClone.clone();
                listObj.append(cln);
                InitSortableComponent(true);
                return cln;
            }

            var AddAndManageItem = function () {
                var item = AddItem();
                ManageItem(item);
                return item;
            }

            var ChangeItemParamsToAdded = function (item, alias, imgPath) {
                item.find('.file-alias').first().val(alias);
                item.find('.addedimg').first().attr("src", imgPath);
                item.find('.file-title').first().val("");
                item.find(".file-added-wrapper").append('<a id="gallery-link" class="gallery-link" href='+imgPath+'><div class="gallery-link-link">View</div></a>');
            }

            if (config.EnableAddButton) {
                var newItem = AddItem();
                ShowItemAddWrapper(newItem);
            }
            else {
                InitSortableComponent(false);
            }

            listObj.children("li").each(function () {
                ManageItem($(this));
            });

            apiDragAndDrop.on("processingDroppedFilesComplete", function (event, files, dropTarget) {
                apiFileUploader.fineUploader("addFiles", files);
            });

            apiFileUploader.on("submit", function (event, id, name) {
                var freeItem = GetFreeItemAdd();
                var alias = null;
                if (freeItem != null) {
                    if (!IsFileAliasNullOrEmpty(freeItem))
                        alias = GetFileAliasValue(freeItem);
                    ShowItemProcessWrapper(freeItem);
                    if (alias == null && config.EnableAddButton) {
                        var newItem = AddAndManageItem();
                        ShowItemAddWrapper(newItem);
                    }
                }
                else if (config.EnableAddButton) {
                    var newItem = AddAndManageItem();
                    ShowItemProcessWrapper(newItem);
                }
                else {
                    alert("Too many items.");
                    return false;
                }
                if (alias == null)
                    alias = "";
                var params = {
                    content_id: config.ContentID,
                    content_field_id: config.ContentFieldID,
                    alias_to_remove: alias
                }
                UploadFile($(this), params);
            }).on("complete", function (self, id, name, responseJSON) {
                var freeItem = GetFreeItemProcess();
                if (responseJSON.success && responseJSON.new_file_alias) {
                    ShowItemAddedWrapper(freeItem);
                    if (!ExistComponents(freeItem))
                        AddComponents(freeItem);
                    ChangeItemParamsToAdded(freeItem, responseJSON.new_file_alias, config.Path + responseJSON.new_file_alias);
                    ChangeQueueValues();
                }
                else {
                    if (responseJSON.error) {
                        if (config.EnableAddButton) {
                            freeItem.remove();
                            ChangeQueueValues();
                        }
                        alert(responseJSON.error);
                    }
                }
            });

        });

    });

    $(function () {

        $(".fileuploader-component").each(function () {

            var self = $(this),
            //componentMsg = $(".component-msg"),
                attachedDocObj = $(".attached-document"),
                attachedLink = $(".attached-link"),
                dropZoneWrapper = self.find(".dropzone-wrapper").first(),
                dropZone = self.find(".dropzone").first(),
                config = $.parseJSON(self.find(">.config").first().html()),
                pathUpload = config.Path,
                fineUploaderConfig = {
                    multiple: false,
                    autoUpload: true,
                    debug: false,
                    validation: {
                        allowedExtensions: ['pdf', 'doc', 'docx', 'txt']
                    },
                    request: {
                        endpoint: pathUpload,
                        inputName: "upload_file"
                    },
                    button: dropZone
                },
                fileUploader = self.children('.fineuploader-component').first(),
                apiFileUploader = fileUploader.fineUploader(fineUploaderConfig),
                apiDragAndDrop = dropZone.fineUploaderDnd(),
                statMes = $(".fileuploader-success-message");

            apiFileUploader.on("submit", function (event, id, name) {
                dropZone.addClass("hide");
                statMes.hide();
                dropZoneWrapper.addClass("active");
                $(this).fineUploader('setEndpoint', pathUpload);
            }).on("complete", function (self, id, name, responseJSON) {
                dropZone.removeClass("hide");
                statMes.show();
                dropZoneWrapper.removeClass("active");
                if (responseJSON.success) {
                    if (responseJSON.content && responseJSON.content != '')
                    {
                        //componentMsg.val(responseJSON.content);
                        attachedDocObj.val(responseJSON.content);
                        attachedLink.remove();
                    }
                    else
                        alert("Uploaded file is empty or cannot be read.\nPlease try again later or fill in your information manually.");
                }
                else if (responseJSON.error) {
                    alert(responseJSON.error);
                }
            });

        });

    });

});

