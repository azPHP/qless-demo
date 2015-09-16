# qless-demo
Demo of running a qless job queue system

To run:

* `composer install`
* `./work.php`

In another shell:

* `./run.php qless:add-job demo` as many times as you want.
* `./run.php help qless:add-job` for other options.

## OSX

* Running in OSX will work, ut you will end up with some odd errors in the worker as it expects to be run on linux where process verbage can be changed, allowing you to to show a worker as "qless:master MyWorker" etc.
