@component('mail::message')
# パスワード再設定のご案内

パスワード再設定のリクエストを受け付けました。
以下のボタンをクリックして、パスワードの再設定を行ってください。

@component('mail::button', ['url' => $resetUrl])
パスワードを再設定する
@endcomponent

このリンクの有効期限は{{ config('auth.passwords.users.expire', 60) }}分です。

※パスワード再設定をリクエストしていない場合は、このメールを無視してください。<br>
※このメールは自動送信されています。返信はできませんのでご了承ください。

Thanks,<br>
{{ config('app.name') }}
@endcomponent