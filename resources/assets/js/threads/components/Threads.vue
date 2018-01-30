<template>
    <div class="card">
        <div class="card-content">
            <div class="card-title">{{ title }}</div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{thread}}</th>
                        <th>{{replies}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Teste</td>
                        <td>3</td>
                        <td>
                            <a href="#">{{open}}</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
      props: [
          'title',
          'thread',
          'replies',
          'open'
      ]
    }
</script>
