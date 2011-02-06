<?php
# DynamicMTML (C) 2010-2011 Alfasado Inc.
# This program is distributed under the terms of the
# GNU General Public License, version 2.

    $mtime = filemtime( $cache );
    if ( ( $ctime - $mtime ) > $server_cache ) {
        unlink( $cache );
    } elseif ( $orig_mtime > $mtime ) {
        unlink( $cache );
        $force_compile = 1;
        $app->stash( 'force_compile', 1 );
    } else {
        if ( $conditional ) {
            $app->do_conditional( filemtime( $cache ) );
        }
        $app->send_http_header( $contenttype, $mtime, filesize( $cache ) );
        $app->echo_file_get_contents( $cache, $size_limit );
        exit();
    }
?>