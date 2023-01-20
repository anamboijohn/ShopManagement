<style>
    label {
            display: flex;
            align-items: center;
    }

    span::after {
            padding-left: 5px;
    }

    input:invalid+span::after {
            content: "×";
            color:red;
    }

    input:valid+span::after {
            content: "✓";
            color:green;
    }
</style>
