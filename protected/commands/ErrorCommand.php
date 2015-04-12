<?php

/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.04.2015
 * Time: 17:05
 */
class ErrorCommand extends CConsoleCommand {

    public function actionTest() {

        $demo = array(
            // Required: access_token
            // An access token with scope "post_server_item" or "post_client_item".
            // A post_client_item token must be used if the "platform" is "browser", "android", "ios", "flash", or "client"
            // A post_server_item token should be used for other platforms.
            "access_token" => "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",

            // Required: data
            "data"         => array(

                // Required: environment
                // The name of the environment in which this occurrence was seen.
                // A string up to 255 characters. For best results, use "production" or "prod" for your
                // production environment.
                // You don't need to configure anything in the Rollbar UI for new environment names;
                // we'll detect them automatically.
                "environment"  => "master",

                // Required: body
                // The main data being sent. It can either be a message, an exception, or a crash report.
                "body"         => array(

                    // Required: "trace", "trace_chain", "message", or "crash_report" (exactly one)
                    // If this payload is a single exception, use "trace"
                    // If a chain of exceptions (for languages that support inner exceptions), use "trace_chain"
                    // If a message with no stack trace, use "message"
                    // If an iOS crash report, use "crash_report"

                    // Option 1: "trace"
                    "trace"        => array(

                        // Required: frames
                        // A list of stack frames, ordered such that the most recent call is last in the list.
                        "frames"    => array(
                            // Each frame is an object.
                            array(
                                // Required: filename
                                // The filename including its full path.
                                "filename" => "/Users/brian/www/mox/mox/views/project.py",

                                // Optional: lineno
                                // The line number as an integer
                                "lineno"   => 26,

                                // Optional: colno
                                // The column number as an integer
                                "colno"    => 8,

                                // Optional: method
                                // The method or function name
                                "method"   => "index",

                                // Optional: code
                                // The line of code
                                "code"     => "_save_last_project(request, project_id, force=True)",

                                // Optional: context
                                // Additional code before and after the "code" line
                                "context"  => array(
                                    // Optional: pre
                                    // List of lines of code before the "code" line
                                    "pre"  => array(
                                        "project = request.context", "project_id = project.id"
                                    ),

                                    // Optional: post
                                    // List of lines of code after the "code" line
                                    "post" => array()
                                ),

                                // Optional: args
                                // List of values of positional arguments to the method/function call
                                // NOTE: as this can contain sensitive data, you may want to scrub the values
                                "args"     => array("<Request object>", 25),

                                // Optional: kwargs
                                // Object of keyword arguments (name => value) to the method/function call
                                // NOTE: as this can contain sensitive data, you may want to scrub the values
                                "kwargs"   => array(
                                    "force" => true
                                )
                            ),
                            array(
                                "filename" => "/Users/brian/www/mox/mox/views/project.py", "lineno" => 497,
                                "method"   => "_save_last_project", "code" => "user = foo"
                            )
                        ),

                        // Required: exception
                        // An object describing the exception instance.
                        "exception" => array(
                            // Required: class
                            // The exception class name.
                            "class"       => "NameError",

                            // Optional: message
                            // The exception message, as a string
                            "message"     => "global name 'foo' is not defined",

                            // Optional: description
                            // An alternate human-readable string describing the exception
                            // Usually the original exception message will have been machine-generated;
                            // you can use this to send something custom
                            "description" => "Something went wrong while trying to save the user object"
                        )

                    ),

                    // Option 3: "message"
                    // Only one of "trace", "trace_chain", "message", or "crash_report" should be present.
                    // Presence of a "message" key means that this payload is a log message.
                    "message"      => array(

                        // Required: body
                        // The primary message text, as a string
                        "body"  => "Request over threshold of 10 seconds",

                        // Can also contain any arbitrary keys of metadata. Their values can be any valid JSON.
                        // For example:

                        "route" => "home#index", "time_elapsed" => 15.23

                    ),

                    // Option 4: "crash_report"
                    // Only one of "trace", "trace_chain", "message", or "crash_report" should be present.
                    "crash_report" => array(
                        // Required: raw
                        // The raw crash report, as a string
                        // Rollbar expects the format generated by rollbar-ios
                        "raw" => "<crash report here>"
                    )

                ),

                // Optional: level
                // The severity level. One of: "critical", "error", "warning", "info", "debug"
                // Defaults to "error" for exceptions and "info" for messages.
                // The level of the *first* occurrence of an item is used as the item's level.
                "level"        => "error",

                // Optional: timestamp
                // When this occurred, as a unix timestamp.
                "timestamp"    => 1369188822,

                // Optional: platform
                // The platform on which this occurred. Meaningful platform names:
                // "browser", "android", "ios", "flash", "client", "heroku", "google-app-engine"
                // If this is a client-side event, be sure to specify the platform and use a post_client_item access token.
                "platform"     => "linux",

                // Optional: language
                // The name of the language your code is written in.
                "language"     => "python",

                // Optional: context
                // An identifier for which part of your application this event came from.
                // Items can be searched by context (prefix search)
                // For example, in a Rails app, this could be `controller#action`.
                // In a single-page javascript app, it could be the name of the current screen or route.
                "context"      => "project#index",

                // Optional: request
                // Data about the request this event occurred in.
                "request"      => array(
                    // Can contain any arbitrary keys. Rollbar understands the following:

                    // url: full URL where this event occurred
                    "url"          => "https://rollbar.com/project/1",

                    // method: the request method
                    "method"       => "GET",

                    // headers: object containing the request headers.
                    "headers"      => array(
                        // Header names should be formatted like they are in HTTP.
                        "Accept" => "text/html", "Referer" => "https://rollbar.com/"
                    ),

                    // params: any routing parameters (i.e. for use with Rails Routes)
                    "params"       => array(
                        "controller" => "project", "action" => "index"
                    ),

                    // GET: query string params
                    "GET"          => array(),

                    // query_string: the raw query string
                    "query_string" => "",

                    // POST: POST params
                    "POST"         => array(),

                    // body: the raw POST body
                    "body"         => "",

                    // user_ip: the user's IP address as a string.
                    // Can also be the special value "$remote_ip", which will be replaced with the source IP of the API request.
                    // Will be indexed, as long as it is a valid IPv4 address.
                    "user_ip"      => "100.51.43.14"

                ),

                // Optional: person
                // The user affected by this event. Will be indexed by ID, username, and email.
                // People are stored in Rollbar keyed by ID. If you send a multiple different usernames/emails for the
                // same ID, the last received values will overwrite earlier ones.
                "person"       => array(
                    // Required: id
                    // A string up to 40 characters identifying this user in your system.
                    "id"       => "12345",

                    // Optional: username
                    // A string up to 255 characters
                    "username" => "brianr",

                    // Optional: email
                    // A string up to 255 characters
                    "email"    => "brian@rollbar.com"
                ),

                // Optional: server
                // Data about the server related to this event.
                "server"       => array(
                    // Can contain any arbitrary keys. Rollbar understands the following:

                    // host: The server hostname. Will be indexed.
                    "host"         => "web4",

                    // root: Path to the application code root, not including the final slash.
                    // Used to collapse non-project code when displaying tracebacks.
                    "root"         => "/Users/brian/www/mox",

                    // branch: Name of the checked-out source control branch. Defaults to "master"
                    "branch"       => "master",

                    // Optiona: code_version
                    // String describing the running code version on the server
                    // See note about "code_version" above
                    "code_version" => "b6437f45b7bbbb15f5eddc2eace4c71a8625da8c",

                    // (Deprecated) sha: Git SHA of the running code revision. Use the full sha.
                    "sha"          => "b6437f45b7bbbb15f5eddc2eace4c71a8625da8c"
                ),

                // Optional: client
                // Data about the client device this event occurred on.
                // As there can be multiple client environments for a given event (i.e. Flash running inside
                // an HTML page), data should be namespaced by platform.
                "client"       => array(
                    // Can contain any arbitrary keys. Rollbar understands the following:

                    "javascript" => array(

                        // Optional: browser
                        // The user agent string
                        "browser"               => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36 OPR/20.0.1387.82",

                        // Optional: code_version
                        // String describing the running code version in javascript
                        // See note about "code_version" above
                        "code_version"          => "b6437f45b7bbbb15f5eddc2eace4c71a8625da8c",

                        // Optional: source_map_enabled
                        // Set to true to enable source map deobfuscation
                        // See the "Source Maps" guide for more details.
                        "source_map_enabled"    => false,

                        // Optional: guess_uncaught_frames
                        // Set to true to enable frame guessing
                        // See the "Source Maps" guide for more details.
                        "guess_uncaught_frames" => false

                    )
                ),

                // Optional: custom
                // Any arbitrary metadata you want to send. "custom" itself should be an object.
                "custom"       => array(),

                // Optional: title
                // A string that will be used as the title of the Item occurrences will be grouped into.
                // Max length 255 characters.
                // If omitted, we'll determine this on the backend.
                "title"        => "NameError when setting last project in views/project.py",


            )
        );
        $parser = new RollbarErrorSaver();
        $parser->save(json_encode($demo));
    }
}