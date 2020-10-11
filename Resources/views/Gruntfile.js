module.exports = function (grunt) {
    'use strict';

    var vendorDir = 'frontend/_public/vendors',
        nodeDir = 'node_modules';

    grunt.initConfig({
        clean: {
            vendors: [vendorDir]
        },
        copy: {
            'lazysizes.min.js': {
                files: [{
                    expand: true,
                    src: [
                        nodeDir + '/lazysizes/lazysizes.min.js'
                    ],
                    dest: vendorDir + '/lazysizes',
                    flatten: true
                }]
            }
        }
    });

    grunt.registerTask('createVendorDir', 'Creates the necessary vendor directory', function () {
        // Create the vendorDir when it doesn't exists.
        if (!grunt.file.isDir(vendorDir)) {
            grunt.file.mkdir(vendorDir);

            // Output a success message
            grunt.log.oklns(grunt.template.process(
                'Directory "<%= directory %>" was created successfully.',
                {data: {directory: vendorDir}}
            ));
        }
    });

    grunt.registerTask('default', ['clean', 'createVendorDir', 'copy']);

    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-copy');
};