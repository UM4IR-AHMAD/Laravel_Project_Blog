

            var element =  document.getElementById('quill-editor-container');
            if (typeof(element) != 'undefined' && element != null)
            {
                var quill = new Quill('#quill-editor-container', {
                    modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        ['link'],
                        // [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        // [{'indent': '-1'},{'indent': '+1'}],
                        [{'color': [] },{ 'background' : [] }],
                        // [{'align' : []}]
                    ]
                    },
                    placeholder: 'Write the post...',
                    theme: 'snow'  // or 'bubble'
                });

                var form = document.querySelector('form');
                form.onsubmit = function() {
                    // Populate hidden form on submit
                    var about = document.querySelector('#description');
                    // about.value = JSON.stringify(quill.getContents());
                    about.value = quill.root.innerHTML;
                };
            }
