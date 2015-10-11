<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
abstract class GithubOAUTH {
    const CLIENT_ID = '';
    const CLIENT_SECRET = '';
    const WEBHOOK_SECRET = '';
}

// Returns true if the github oauth details above have been filled out, false otherwise.
// If false, you should fill out the class above with details for your oauth.
function is_github_details_valid() {
    return GithubOAUTH::CLIENT_ID !== "" && GithubOAUTH::CLIENT_SECRET !== "" && GithubOAUTH::WEBHOOK_SECRET !== "";
}
